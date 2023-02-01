import java.lang.reflect.Executable;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Random;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.Executor;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.ThreadLocalRandom;
import java.util.concurrent.TimeUnit;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.concurrent.ArrayBlockingQueue;
import java.util.concurrent.BlockingQueue;

public class FieldRace {
    public static final int PLAYER_COUNT = 10;
    public static final int CHECKPOINT_COUNT = 4;
    public static AtomicBoolean isOn = new AtomicBoolean(true);
    public static ConcurrentHashMap<String, Integer> scores = new ConcurrentHashMap<String, Integer>();
    public static AtomicInteger[] checkpointScores = new AtomicInteger[PLAYER_COUNT];
    private static List<BlockingQueue<AtomicInteger>> checkpointQueues = Collections
            .synchronizedList(new ArrayList<BlockingQueue<AtomicInteger>>());

    public static void main(String[] args) {
        ExecutorService service = Executors.newFixedThreadPool(PLAYER_COUNT + CHECKPOINT_COUNT + 1);
        for (int i = 0; i < PLAYER_COUNT; i++) {
            checkpointScores[i] = new AtomicInteger(0);

        }
        for (int i = 0; i < CHECKPOINT_COUNT; i++) {
            checkpointQueues.add(i, new ArrayBlockingQueue<AtomicInteger>(CHECKPOINT_COUNT));
        }
        for (int i = 0; i < PLAYER_COUNT; i++) {
            scores.put("Player " + i, 0);
        }
        service.execute(() -> {
            while (isOn.get()) {
                try {
                    Thread.sleep(1000);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

                System.out.printf("Scores: ");
                for (int i = 0; i < PLAYER_COUNT; i++) {
                    System.out.printf("Player " + i + ": " + scores.get("Player " + i) + " ");

                }
                System.out.println();
            }
        });
        // checkpoint stuff
        for (int i = 0; i < CHECKPOINT_COUNT; i++) {
            final int checkpoint = i;
            service.execute(() -> {
                while (isOn.get()) {
                    try {
                        Thread.sleep(1000);
                        AtomicInteger player = checkpointQueues.get(checkpoint).poll(2, TimeUnit.SECONDS);
                        if (player != null) {
                           synchronized(player) {  
                            player.set(ThreadLocalRandom.current().nextInt(10,100));
                            player.notify();
                           }
                        }


                    } catch (InterruptedException e) {
                    
                    }

                }
            });
        }
// player stuff
        for (int i = 0; i < PLAYER_COUNT; i++) {
            final int j = i;
            service.execute(() -> {
                while (isOn.get()) {
                    try { 
                        AtomicInteger checkpointScore = checkpointScores[j];
                        int checkpoint = ThreadLocalRandom.current().nextInt(0, CHECKPOINT_COUNT);
                        Thread.sleep(ThreadLocalRandom.current().nextInt(500, 2000));
                        synchronized(checkpointQueues) {
                        checkpointQueues.get(checkpoint).put(checkpointScore);
                        }
                        synchronized (checkpointScore) {
                          checkpointScore.wait();
                        }
                        
                        System.out.printf("Player %d got %d points at checkpoint %d\n", ThreadLocalRandom.current().nextInt(0, PLAYER_COUNT), ThreadLocalRandom.current().nextInt(10,100), checkpoint);
                        scores.put("Player " + j, scores.get("Player " + j) + checkpointScore.get());
                        checkpointScore.set(0);
                    } catch (InterruptedException e) {
                        
                    }

                }
            });
        }



        try {
            Thread.sleep(10000);
            isOn.set(false);
            ((ExecutorService) service).shutdown();
            ((ExecutorService) service).awaitTermination(3, TimeUnit.SECONDS);
            ((ExecutorService) service).shutdownNow();

        } catch (InterruptedException e) {
            e.printStackTrace();
        }

        System.out.println("Final Scores: ");
        for (int i = 0; i < PLAYER_COUNT; i++) {
            System.out.printf("Player " + i + ": " + scores.get("Player " + i) + " ");
        }

    }

    
}