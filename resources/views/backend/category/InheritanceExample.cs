using System;

namespace Unit3{
    class User{
        public string Name;
        private string location;
        public string Location{
            get{
                return location;
            }

            set{
                location=value;
            }
        };

        public User(){
            System.Console.WriteLine("This is base class constructor");
        }

        public void PrintUserData(){
            System.Console.WriteLine("Name :{0}\tLocation:{1}",Name,Location);
        }

        public void SetLocation(){

        }
    }

    class UserDetails:User{
        public int Age;

        public UserDetails(){
            System.Console.WriteLine("Child class Constructor");
        }

        public void PrintUserDetails(){
            System.Console.WriteLine("Name :{0}\tLocation:{1}\tAge{2}",Name,Location,Age);
        }
    }

    class InheritExample{
        static void Main(string[] args)
        {
            UserDetails ud = new UserDetails();
            ud.Name = "Ranju";
            ud.Location = "Hariya Dada";
            ud.Age = 20;
            ud.PrintUserDetails();
        }
    }
}