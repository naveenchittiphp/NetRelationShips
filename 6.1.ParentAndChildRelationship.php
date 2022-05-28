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
            
             public void RemoveItem(int ProductId,int Quanity)
        {
            var item = Items.FirstOrDefault(item => item.ProductId == ProductId);
            item.Quanitity -= Quanity;
            if(item.Quanitity == 0)
            {
                Items.Remove(item);
            }
        }
            here we are remove the item from the basket.
            first we will find the any item matches the productId 
            if matches then we will reduse the quantity 
            if quantity is 0 then we will remove the item from basketItem table.
            
            
          
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
            
            ------------------------------
            DbContext
            -------------------------------
            In db context we need add Baskets connection only 
            because we never get any BasketItem induvidually 
            
            in Basket we have list of items so here we have one to many relationship.
            
            Each BasketItem has one product 
            
            since we placed 
              //Navigation property
        public int ProductId { get; set; }
        public Product Product { get; set; }
            while migration we get this 
             onDelete: ReferentialAction.Cascade
            meance if we delete a product all basketItem related to the item will deleted.
            
            onDelete: ReferentialAction.Restrict
            here this meance if we delete BasketItem nothing happens to the Products now product will be removed.
            
            -------------------
            Migration 
            ------------
            
            using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace EFCoreRelationship.Migrations
{
    public partial class AddedBasketEntity : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Baskets",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    BuyerId = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Baskets", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "BasketItem",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Quanitity = table.Column<int>(type: "int", nullable: false),
                    ProductId = table.Column<int>(type: "int", nullable: false),
                    BasketId = table.Column<int>(type: "int", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_BasketItem", x => x.Id);
                    table.ForeignKey(
                        name: "FK_BasketItem_Baskets_BasketId",
                        column: x => x.BasketId,
                        principalTable: "Baskets",
                        principalColumn: "Id");
                    table.ForeignKey(
                        name: "FK_BasketItem_Products_ProductId",
                        column: x => x.ProductId,
                        principalTable: "Products",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_BasketItem_BasketId",
                table: "BasketItem",
                column: "BasketId");

            migrationBuilder.CreateIndex(
                name: "IX_BasketItem_ProductId",
                table: "BasketItem",
                column: "ProductId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "BasketItem");

            migrationBuilder.DropTable(
                name: "Baskets");
        }
    }
}

            we get a migration like this 
            
            
          in this   
            ProductId = table.Column<int>(type: "int", nullable: false),
            so if we add a record to BasketItem product id should be there it is correct
                    BasketId = table.Column<int>(type: "int", nullable: true)
            if we add a item to basket basket id should not be nullable because we need to know which item this basketItems are going.
            
            But we dont want this.so we need to add basket (Parent) to basketItem (Child)
            
            public int BasketId { get; set; }
        public Basket Basket { get; set; }
            
            Now run migration then the migration will be look like this 
            
            using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace EFCoreRelationship.Migrations
{
    public partial class BasketEntityAdded : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "Baskets",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    BuyerId = table.Column<string>(type: "nvarchar(max)", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_Baskets", x => x.Id);
                });

            migrationBuilder.CreateTable(
                name: "BasketItems",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    Quanitity = table.Column<int>(type: "int", nullable: false),
                    ProductId = table.Column<int>(type: "int", nullable: false),
                    BasketId = table.Column<int>(type: "int", nullable: false)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_BasketItems", x => x.Id);
                    table.ForeignKey(
                        name: "FK_BasketItems_Baskets_BasketId",
                        column: x => x.BasketId,
                        principalTable: "Baskets",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                    table.ForeignKey(
                        name: "FK_BasketItems_Products_ProductId",
                        column: x => x.ProductId,
                        principalTable: "Products",
                        principalColumn: "Id",
                        onDelete: ReferentialAction.Cascade);
                });

            migrationBuilder.CreateIndex(
                name: "IX_BasketItems_BasketId",
                table: "BasketItems",
                column: "BasketId");

            migrationBuilder.CreateIndex(
                name: "IX_BasketItems_ProductId",
                table: "BasketItems",
                column: "ProductId");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "BasketItems");

            migrationBuilder.DropTable(
                name: "Baskets");
        }
    }
}

            
            Now we can see some changes 
            
             ProductId = table.Column<int>(type: "int", nullable: false),
                    BasketId = table.Column<int>(type: "int", nullable: false)
            
            so if we create an BasketItem product id and Basket Id should be there.
            
            if we remove the bakset item or product 
            
            basket item should be alse deleted.
            
            
         
          
          
          
          
