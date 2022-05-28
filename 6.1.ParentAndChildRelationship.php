Office -> An Office has many employess.
Employee -> An employee has one laptop.

Office has many employees , Employees has one laptop and belongs to one office.

Office and employees has one to many relationships.

employee and laptop has one to one relationship.

The way we configure these in entity framework ins conventions.

Lets create New office , employee and laptop entity.

namespace EFCoreRelationship
{
    public class Office
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string UserId { get; set; }
        public List<Employee> Employees { get; set; } = new();
    }
}

here the office has many employees so we given employees as a list of employess datatype (meance all the properties in emplyoees will load).
          
          
 Let there is a another example Basket 
          
          
          every user have a basket he will add each product in to the basket.
          then the items in basket are basket items and these all are belongs to user.
          
          Here user may choose the basket items without login so we use cookies to store the user information 
          and it is a randomly generated id.
          
          So we initilize the any basket then we will load all items belongs to that basket also.
          
          for this we have to initilize the basket property in our Baket entity.
          
          namespace EFCoreRelationship
{
    public class Basket
    {
        public int Id { get; set; }
        public string BuyerId { get; set; }
        public List<BasketItem> Items { get; set; } = new();

    }
}

          namespace EFCoreRelationship
{
    public class BasketItem
    {
        public int Id { get; set; }
        public int Quanitity { get; set; }
        public int ProductId { get; set; }
        public Product Product { get; set; }
    }
}
          
         * so here we are telling Basket item the way we get product 
          first we specify the relational key ProductId 
          then we give the property of datatype Product and name is product.
          
          Adding of baket item 
          we have to add product to the basket item . While adding we should check it is added already added or newly adding.
          If it is newly adding we dont need to increase the BasketItem Quanity otherwise we should add new increase the basket item quanity.
          
          
          
          ----------------------------------------------------------------------------------------------
          Baket Entity
          -----------------------------------------------------------------------------------------------
          
          
         public class Basket
        {
        public int Id { get; set; }
        public string BuyerId { get; set; }
        public List<BasketItem> Items { get; set; } = new();

        public void AddItem(Product Product, int quanity)
        {
            if (Items.All(item => item.ProductId != Product.Id))
            {
                Items.Add(new BasketItem { Product = Product, Quanitity = quanity });
            }

            var existingItem = Items.FirstOrDefault(item => item.ProductId == Product.Id);
            if (existingItem != null) existingItem.Quanitity += quanity;
        }
      }
          
          ****
          
          here items meance not all basket items in the basketItem table.
          Baketitems meance all the items belongs to the users basket only 
            
           if (Items.All(item => item.ProductId != Product.Id))
            {
                Items.Add(new BasketItem { Product = Product, Quanitity = quanity });
            }

          in those items we are checking if any of item has same product item 
          if there thne we dont add that to the basket item 
          if not there then will add that to the basket item.
          here we didnot pass the Product id 
          since we are mention the ProductId property entity will understand 
          the ProductId is the key from product.id and it automatically assign product.id to ProductId 
          
          var existingItem = Items.FirstOrDefault(item => item.ProductId == Product.Id);
            if (existingItem != null) existingItem.Quanitity += quanity;
          
          here we are check any of  the basket items have product.id 
          if we have then we are adding same product to our basket 
          Insted of adding same product to again into the basketItem we will increase the quanity.
          
          
         
          
          
          
          
