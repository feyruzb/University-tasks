import java.util.List;
import java.util.ArrayList;
interface SalariedEntity
{
    public int getSalary();
    public void raiseSalary(float percent);
    public String getName();
}
class Subcontractor implements SalariedEntity
{
    private long taxNumber;
    private int salary;
    public Subcontractor(long taxNumber, int salary)
    {
        this.taxNumber = taxNumber;
        this.salary = salary;
    }

    @Override
    public int getSalary() {
        return salary;
    }

    @Override
    public void raiseSalary(float percent) {}

    @Override
    public String getName() {
        
        return null;
    }
}
// i did
class Company{
    private List<SalariedEntity> entities;
    
    public Company()
    {
        entities = new ArrayList<SalariedEntity>();
    }
    public void AddEntity(SalariedEntity e)
    {
        entities.add(e);
    }
    public void RemoveEntity(SalariedEntity e)
    {
        entities.remove(e);
    }
    public void raiseSalary(float percent) {
        for (SalariedEntity a : entities) { 
            if (a instanceof Employee) a.raiseSalary( percent );
        }
    }



    public void Timesavior() {
        for (SalariedEntity a : entities) { 
            if (a instanceof Employee) {
                System.out.println("Name: " + a.getName() + " Salary: " + a.getSalary());
            }
        }

    }



}
// i did
public abstract class Employee implements SalariedEntity
{   

    private String name;
    protected int salary;
    
   
    public Employee(String name, int salary)
    {
        this.name = name;
        this.salary = salary;
    }
    public String getName() { return name; }
    public abstract int getSalary();
    public void raiseSalary(float percent)
    {
        salary *= (1+percent); //salary += salary * percent;
    }
}
class Manager extends Employee
{
    private List<Employee> employees;
    public Manager(String name, int salary)
    {
        super(name, salary);
        employees = new ArrayList<Employee>();
    }
    public void addEmployee(Employee e)
    {
        employees.add(e);
    }
    public void removeEmployee(Employee e)
    {
        employees.remove(e);
    }
    public int getSalary()
    {
        return salary + employees.stream().mapToInt(x -> x.getSalary()).sum() * 5/100; 
    }
}
class Subordinate extends Employee
{
    public Subordinate(String name, int salary)
    {
        super(name, salary);
    }
    public int getSalary() { return salary; }
}
class EmployeeTest
{
    static public void main(String[] args)
    {  
        Manager emp1 = new Manager("Joe", 1000);
        Subordinate sub1 = new Subordinate("Mike", 100);
        Subordinate sub2 = new Subordinate("Sarah", 200);
        emp1.addEmployee(sub1);
        emp1.addEmployee(sub2);
        System.out.println("Name: " + emp1.getName() + " Salary: " + emp1.getSalary());

        Company c = new Company();
        Subordinate sub3 = new Subordinate("Sarah3", 200);
        c.AddEntity(sub3);
        Subordinate sub4 = new Subordinate("BIB", 300);
        c.AddEntity(sub4);
        c.raiseSalary(1);
        // System.out.println("Name: " + sub3.getName() + " Salary: " + sub3.getSalary());
        // System.out.println("Name: " + sub4.getName() + " Salary: " + sub4.getSalary());
        c.Timesavior();

    } 
}  
