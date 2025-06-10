using System;

namespace Unit3
{

    interface Data
    {
        void PrintData(string value);
    }

    class DisplayName : Data
    {
        public void PrintData1(string value)
        {
            Console.WriteLine("Name:" + value);
        }

        public void PrintData(string value)
        {
            Console.WriteLine("Name:" + value);
        }
    }

     class DisplayAddress : Data
    {
        public void PrintData(string value)
        {
            Console.WriteLine("Address : " + value);
        }
    }
}