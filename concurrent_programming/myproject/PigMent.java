import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.PriorityBlockingQueue;
import java.util.concurrent.ThreadLocalRandom;
import java.util.concurrent.atomic.AtomicInteger;
import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class PigMent implements Runnable {
    private static final int TICK_MIN = 100;
    private static final int TICK_MAX = 500;
    private static final int FEED = 10;
    private static final int BMR = 5;
    private static final int INIT_MASS = 20;
    private static final int MAX_POP = 10;
    private static final int INIT_POP = 3;

    private static AtomicInteger pigIdCounter = new AtomicInteger(0);
    private static ExecutorService pigPool = Executors.newFixedThreadPool(MAX_POP);
    private static PriorityBlockingQueue<PigMent> openArea = new PriorityBlockingQueue<>(MAX_POP, (a,b) -> a.mass - b.mass);
    private static Lock lock = new ReentrantLock();
    
    private int id;
    private int mass;

    public PigMent(int mass) {
        this.id = pigIdCounter.incrementAndGet();
        this.mass = mass;
    }

    public static void pigSleep() throws InterruptedException {
        int sleepTime = ThreadLocalRandom.current().nextInt(TICK_MIN, TICK_MAX); 
        
        Thread.sleep(sleepTime);
    }

    public void pigSay(String msg) {
        System.out.println(" <Pig#" + id + "," + mass + "kg>: " + msg);
    }

    public boolean aTerribleThingToDO() throws InterruptedException {
        PigMent prey = openArea.peek();
        openArea.add(this);
        pigSleep();
        if (prey != null) {
            boolean preyRemoved = openArea.remove(prey);
            if (preyRemoved) {
                pigSay("Bless me, Father, for I have sinned.");
            }
        }
        int massGained = prey.mass;
        mass += massGained;
        boolean allive = openArea.remove(this);
        return allive;
    }


    public boolean eatLight() throws InterruptedException {
        lock.lock();
        openArea.add(this);
        pigSay("Holy crap, I just ate light!");
        pigSleep();

        int massGained = FEED;
        int massLost = mass / BMR;
        mass += massGained - massLost;

        if (mass / BMR > FEED / 2 && pigIdCounter.get() < MAX_POP ) {
            PigMent newPig = new PigMent(mass / 2);
            pigSay("This vessel can no longer hold the both of us!");
            pigPool.execute(newPig);
            mass /= 2;
        }
        boolean removed = openArea.remove(this);
        

        lock.unlock();
        return mass > 0 && removed;
        
    }

    @Override
    public void run() {
        try {
            pigSay("Beware world, for I'm here now!");
            while (aTerribleThingToDO() && eatLight()) {
                pigSleep();
            }
            pigSay("I have endured unspeakable horrors. Farewell, world!");
        } catch (Exception e) {
            System.out.println("Terminated" + " <Pig#" + id + "," + mass + "kg>:");
        }
    }

    public static void main(String[] args) {
        for (int i = 0; i < INIT_POP; i++) {
            pigPool.execute(new PigMent(INIT_MASS));
        }
        while (pigIdCounter.get() < MAX_POP) {
            try {
                Thread.sleep(1000);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
            pigPool.shutdownNow();
            System.exit(0);
    }
}
