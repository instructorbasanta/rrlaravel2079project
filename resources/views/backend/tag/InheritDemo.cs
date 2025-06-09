using System;

namespace Unit3
{
    class Person
    {
        private int id, phone;
        private string name, address;

        public int Id
        {
            get
            {
                return id;
            }
            set
            {
                id = value;
            }
        }
        public int Phone
        {
            get
            {
                return phone;
            }
            set
            {
                phone = value;
            }
        }

        public string Name
        {
            get
            {
                return name;
            }
            set
            {
                name = value;
            }
        }

        public string Address
        {
            get
            {
                return address;
            }
            set
            {
                address = value;
            }
        }

        public Person(int id, string n, string a, int p)
        {
            this.id = id;
            this.name = n;
            this.address = a;
            this.phone = p;
        }

        public void PrintPersonData()
        {
            Console.WriteLine("Id:{0}\tName:{1}\tPhone:{2},\tAddress:{3}", id, name, phone, address);
        }
    }

    class Student : Person
    {
        private string course;
        private int grade, fee, marks;

        public int Grade { get; set; }
        public int Fee { get; set; }

        public int Marks { get; set; }

        public string Course { get; set; }

        public Student(int i, string n, string a, int p, int f, string c, int m, int g) : base(i, n, a, p)
        {
            fee = f;
            course = c;
            marks = m;
            grade = g;
        }


        public void PrintStudentData()
        {
            Console.WriteLine("Id:{0}\tName:{1}\tPhone:{2},\tAddress:{3}\tCourse:{4}\tGrade:{5}\tFee:{6}\tMarks:{7}", Id, Name, Phone, Address, course, grade, fee, marks);
        }
    }

    public class TestDemo
    {
        static void Main(string[] args)
        {
            Student s = new Student(12, "Ranjit", "KTM", 98545454, 12000, "BCA", 56, "C");
            s.PrintStudentData();
        }
    }
}
