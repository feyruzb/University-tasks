import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Random;
public class Switchero {

    public static void main(String[] args){

        ArrayList<Integer> array = new ArrayList<Integer>();
        List<Integer> sure = Collections.synchronizedList(array);
        for(int i=0;i < 100;i++){
            array.add(1000);
        }
        int sum_initial = 0;
        for (int j = 1; j < 10_000; j++) {
            for (int s = 0 ; s <array.size();s++){
                sum_initial += array.get(s);
             }


        ArrayList<Thread> a = new ArrayList<Thread>();
        for (int i = 0; i < 10; i++) {
            int CurrentThread = i ;
    
            


            a.add(new Thread(() -> { ;  
                
                    Random rand = new Random();
                    synchronized(sure){
                    int index_one = rand.nextInt(100);

                    int number_it_a =array.get(index_one);
                    int index_two= rand.nextInt(100);
                    int number_it_b =array.get(index_two);
                    // System.out.println("Apha " + index_one);
                    
                    int random_transfer = rand.nextInt(number_it_a);
                   
                    int new_number_alpha = number_it_a;
                    int new_number_beta = number_it_b;
                    
                    new_number_alpha -= random_transfer;
                    new_number_beta  += random_transfer;
                    if(number_it_a < 0 ){
                        number_it_a = 0;
                    }
                    
                    array.set(index_one , new_number_alpha);
                    array.set(index_two , new_number_beta);

                    int new_array_number_alpha = array.get(index_one);
                    int new_array_number_beta = array.get(index_two);


                    System.out.println("Currect thread == "+ CurrentThread + " index number one= " + index_one + " initial number one = " + number_it_a + " New number one" + new_number_alpha + " Random nubmber= " + random_transfer );
                    System.out.println("Currect thread == "+ CurrentThread + " index number two= " + index_two + " initial number two = " + number_it_b + " New number two= " + new_number_beta + " Random nubmber= " + random_transfer );
                    
                }
                

                
            
            }));
             a.get(i).start();
        }
        int sum_final = 0;
        for (int s = 0 ; s <array.size();s++){
            sum_final += array.get(s);
         }
        
        if (sum_final == sum_initial){
            System.out.println("The sum is equal");
        }else{System.out.println("The sum is not  equal");;

        


        for (int i = 0; i < a.size(); i++) {

            try{a.get(i).join();}
            catch(InterruptedException e){}
         }
         

    }
}}}
