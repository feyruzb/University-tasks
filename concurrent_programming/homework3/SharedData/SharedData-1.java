import java.util.List;
import java.util.ArrayList;

class AccessListThread extends Thread
{
    private boolean isOdd;
    private List<Integer> list; 
    public AccessListThread(boolean isOdd, List<Integer> list)
    {
        this.isOdd = isOdd; this.list = list;
    }
    public void run()
    {
        for (int i = 1; i < 1_000_000; i++) {
            //System.out.println(i + " " + list);
            synchronized (list) {
            if (isOdd && (i % 2) == 1 ||
                !isOdd && (i % 2) == 0) {
                    if (list.size() == 0 && !isOdd ||
                        list.size() != 0 && list.get(list.size() - 1) != i-1) { i--; continue; }
                    //synchronized (list) {
                        list.add(i);
                    //}
                }
            }
        }
    }
}
public class SharedData
{
    public static void main(String[] args)
    {
        List<Integer> list = new ArrayList<>();
        Thread thread1 = new AccessListThread(false, list);
        Thread thread2 = new AccessListThread(true, list);
        thread1.start(); thread2.start();
        try {
            thread1.join(); thread2.join();
            int outOfOrder = 0;
            for (int i = 0; i < list.size()-1; i++) {
                if (list.get(i) == null) continue;
                if (list.get(i+1) == null) continue;
                if (list.get(i) > list.get(i+1)) outOfOrder++;
            }
            System.out.println(list.size() + " out of order " + outOfOrder);
        } catch (InterruptedException e) {}
    }
}