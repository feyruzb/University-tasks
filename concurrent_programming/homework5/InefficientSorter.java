import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Random;

public class InefficientSorter {

      public static void main(String[] args){

        ArrayList<Integer> array = new ArrayList<Integer>();
        List<Integer> sure = Collections.synchronizedList(array);
       
        Random rand = new Random();
        for(int i=0;i < 100;i++){
            array.add(rand.nextInt(10_000)); // filling the main array
        }
        ArrayList<Integer> array2 = new ArrayList<Integer>(array); // cloning the array
        ArrayList<Integer> initial_array = new ArrayList<Integer>(array); // creating copy of the initial array
      
       
        Collections.sort(array2);
        

   

        ArrayList<Thread> a = new ArrayList<Thread>();
        for (int i = 0; i < 10000; i++) {

            a.add(new Thread(() -> { ;  
                synchronized(sure){
                    int index_one = rand.nextInt(array.size());
                    int index_two = rand.nextInt(array.size());
                   
                    if(index_one < index_two && array.get(index_one) > array.get(index_two) ){  
                            
                            Collections.swap(array, index_one, index_two);
                        
                    }else if(index_one > index_two && array.get(index_one) < array.get(index_two)){
                           
                            Collections.swap(array, index_two ,index_one);
                    }
                    

                   

                }
                
                
            
            }));
            a.get(i).start();
        }
       
       
        boolean is_similar = true; 
        for (int i : array) {
        if (!initial_array.contains(i)) is_similar = false;
        }
        System.out.println("Are lists similar  : " + is_similar );

        
        

        boolean same = true;
        for (int i = 0; i < array.size(); i++) {
        if (array.get(i) != initial_array.get(i)) same = false;
        }
        System.out.println("Are elements the same : " + same);

        for (int i = 0; i < a.size(); i++) {

            try{a.get(i).join();}
            catch(InterruptedException e){}
         }
         

    }
}
