import java.util.ArrayList;





public class CreateThreads
{
    private static int counter = 0;
    private static long sum = 0;
    private static void sumInRange(){
        long start = counter * 100_000_000;
        long end = start + 100_000_000;
        synchronized(CreateThreads.class){
        for (long i = start; i < end; i++)
        {
               sum += 1;
        }
    }
        System.out.println(sum);
    
    }



    public static void main(String args[]) {
       
        long start = System.nanoTime();
        ArrayList<Thread> a = new ArrayList<Thread>();
        for (int i = 0; i < 10; i++) {
            a.add(new Thread(() -> {  sumInRange();  }));
             a.get(i).start();
        }
        for (int i = 0; i < a.size(); i++) {
         
            try{a.get(i).join();}
            catch(InterruptedException e){}
         }

         System.out.println(( "The time that this program used to run is " + (System.nanoTime() - start) / 1000000) + "ms");


        
    }
}