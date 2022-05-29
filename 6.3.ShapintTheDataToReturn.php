Here when we want to get data we can see the error 

Here all entities have relationships 

so 

--------------------
Basket item
--------------

using System.ComponentModel.DataAnnotations.Schema;

namespace EFCoreRelationship
{   [Table("BasketItems")]
    public class BasketItem
    {
        public int Id { get; set; }
        public int Quanitity { get; set; }

        //Navigation property
        public int ProductId { get; set; }
        public Product Product { get; set; }

        public int BasketId { get; set; }
        public Basket Basket { get; set; }
    }
}

----------------------
Basket
--------------------

using System.Linq;

namespace EFCoreRelationship
{
    public class Basket
    {
        public int Id { get; set; }
        public string BuyerId { get; set; }
        public List<BasketItem> Items { get; set; } = new();

      
    }
}
          
          in basket we have basketItem and in basketItem we have basket 
          so it load again the basket and basketItem again and again.
          
          it goes into a continues loop and error will come so to get proper data we have to do following things.
          For this we have to create a new folder called DTO 
          
----------------
 BasketDTO
-------------------
          
 namespace EFCoreRelationship.DTO
{
    public class BasketDTO
    {
        public int Id { get; set; }
        public string BuyerId { get; set; }
        public List<BasketItemDTO> Items { get; set; }
    }
}

 -----------------
 BasketItemsDTO
 ------------------
          
   namespace EFCoreRelationship.DTO
{
    public class BasketItemDTO
    {
        public int ProductId { get; set; }
        public string Name { get; set; }
        //public long Price { get; set; }
       // public string PrictureUrl { get; set; }
        //public string Brand { get; set; }
       // public string Type { get; set; }
  
        //public int Id { get; set; }
        public int Quanitity { get; set; }

        //Navigation property
       
    }
}
          
          in basket item dto we are using the product properties to get product information and also basketItem properties 
          
          product properties
          ---------------------
            public int ProductId { get; set; }
        public string Name { get; set; }
        public long Price { get; set; }
       public string PrictureUrl { get; set; }
       public string Brand { get; set; }
       public string Type { get; set; }
          
          BaksetItem properties
          ----------------------
           public int Quanitity { get; set; }
          
          assigning the product properties and basket item property 
          -----------------------------------------------------------
          
            return new BasketDTO
            {
                Id = Basket.Id,
                BuyerId = Basket.BuyerId,
                Items = Basket.Items.Select(item => new BasketItemDTO
                {
                    ProductId = item.ProductId,
                    Name = item.Product.Name,
                    Quanitity = item.Quanitity
                }).ToList()
            };
          
          so we are returning the basket DTO 
          
          assigning the values of basket.id , buyerId to BasketDTO properties.
          for Items we are using Basket.Items 
          for each item we are creating new BasketItemDTO instance and in that we are assigning properties and assigning to Items.
          
