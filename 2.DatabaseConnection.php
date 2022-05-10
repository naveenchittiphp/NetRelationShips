Add a new folder to the project called Data 
now add a new file DataContext.cs 

in this file we will git the database connection.

Make the file as database file by mentioning DbContext 

namespace EFCoreRelationship.Data
{
    public class DataContext:DbContext
    {
    }
}

when ever we type DbContext we will get sugession to install package of entity framework 
lets click on that option and install the entity framework core this a new package will be added.


using Microsoft.EntityFrameworkCore;
namespace EFCoreRelationship.Data
{
    public class DataContext:DbContext
    {

    }
}


Now add a constructor to the class 
in the aurgment pass the DbContextOptions class which takes DbContext as Options 

using Microsoft.EntityFrameworkCore;

namespace EFCoreRelationship.Data
{
    public class DataContext:DbContext
    {
        public DataContext(DbContextOptions<DataContext>  options) : base(options)
        {

        }
    }
}

 Now go to the appsettings.json 
          add a connection string : 
          {
  "ConnectionStrings": {
    "DefaultConnection": "server=localhost;database=efcorerelationships;trusted_connection=true;"
  },
  "Logging": {
    "LogLevel": {
      "Default": "Information",
      "Microsoft.AspNetCore": "Warning"
    }
  },
  "AllowedHosts": "*"
}

-------------------------------------------
          For database connection first we have to install the following packages 
          1)Entity framework sql server 
          2)Design 
          3)tools 
          
          Now open the program.cs 
          
          add a link to database 
          
          using EFCoreRelationship.Data;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container (This is the new connection string)

builder.Services.AddDbContext<DataContext>(options => {
    options.UseSqlServer(builder.Configuration.GetConnectionString("DefaultConnection"));
        });
builder.Services.AddControllers();
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();

          
          -----------------
          final page will looklike this : 
          
          using EFCoreRelationship.Data;
using Microsoft.EntityFrameworkCore;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.
builder.Services.AddDbContext<DataContext>(options => {
    options.UseSqlServer(builder.Configuration.GetConnectionString("DefaultConnection"));
        });
builder.Services.AddControllers();
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();

          
