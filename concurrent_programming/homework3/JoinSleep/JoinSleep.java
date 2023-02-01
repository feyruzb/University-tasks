public class JoinSleep
{
    public static void main(String[] args) {
        Thread thread1 = new Thread(() -> {
            for (int i = 0; i < 10000; i++) {
                System.out.println("hello");
                try {
                    if (i != 9999) Thread.sleep(5);
                } catch (InterruptedException e) {
                    System.out.println("Thread1 Interrupted");
                }
            }
            });
        Thread thread2 = new Thread(() -> {
            for (int i = 0; i < 10000; i++) {
                System.out.println("world");
                try {
                    if (i != 9999) Thread.sleep(5);
                } catch (InterruptedException e) {
                    System.out.println("Thread2 Interrupted");
                }
            }
             });
             Thread thread3 = new Thread(() -> {
                for (int i = 0; i < 10000; i++) {
                    int x = (Thread.currentThread().getThreadGroup().activeCount() -1 );
                    System.out.println(x);
                    try {
                        if (i != 9999) Thread.sleep(5);
                        if (x == 1) System.exit(0);
                    } catch (InterruptedException e) {
                        System.out.println("Thread3 Interrupted");
                    }
                }
                });
                

        thread1.start(); thread2.start(); thread3.start();
        try {
            Thread.sleep(1000);
            thread1.interrupt();
            thread2.interrupt();
            thread3.interrupt();
            thread1.join(); thread2.join(); thread3.join();
            
        } catch (InterruptedException e) {
            System.out.println("Thread interrupted");
        }
        System.out.println("ready");
        
}
}
