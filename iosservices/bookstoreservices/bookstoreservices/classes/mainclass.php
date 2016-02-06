<?php
$root = $_SERVER['DOCUMENT_ROOT'];
/*
include_once $root.'/services/connection/db.php';
include_once $root.'/services/classes/publicClass/commanClass.php';
include_once $root.'/services/classes/publicClass/responseClass.php';
*/
include_once 'connection/db.php';
include_once 'publicClass/responseClass.php'; 


error_reporting(E_ALL ^ E_DEPRECATED);
//Create Connection Class
class UserClass
{
   	var $conn;
	//constructor to eastablishment connection with database
	public function __construct()
	{
		$conn= new connection();
        return $this->conn;
    }
	/*********Query start Following Block 1********/
	public function getStateDetail()
	{
                  //$sql = "SELECT DISTINCT state FROM stores";
				   $sql = "SELECT DISTINCT m.state, (SELECT COUNT( storeName )FROM stores WHERE state = m.state) AS No_of_store FROM stores m ORDER BY state";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCityDetail($state)
	{
                 // $sql = "SELECT city FROM stores  where  state='$state'";
				 $sql = "SELECT DISTINCT m.city, (SELECT COUNT( storeName )FROM stores WHERE city = m.city) AS No_of_store FROM stores m WHERE state='$state' ORDER BY city";
				  $result=mysql_query($sql);
			      return $result;	
	}
	public function getOnlystateDetail($state)
	{
				 $sql = "SELECT * from stores WHERE state='$state'";
				  $result=mysql_query($sql);
			      return $result;	
	}
	public function getBookDetail($type,$typeno)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getBook_StoreDetailByState_title($type,$typeno,$state) 
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND stores.state='$state' GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND stores.state='$state' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND stores.state='$state' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND stores.state='$state' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getZipcodeDetail($state,$city) 
	{ 
                  //$sql = "SELECT * from stores WHERE state='$state' AND city='$city' GROUP BY storeName";
				 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, storereviews WHERE state='$state' AND city='$city' GROUP BY storeName";
				  $result=mysql_query($sql);
			      return $result;
	}
	public function getCategoryDetail()
	{
                  $sql = "SELECT distinct category FROM  books ORDER BY category";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getOnlyCategoryDetail($category)
	{
                  $sql = "SELECT * FROM books WHERE category='$category'";
		          $result=mysql_query($sql); 
			      return $result;	
	}
	public function getSubCategoryDetail($category)
	{
                  $sql = "SELECT distinct subCat FROM books where category='$category' ORDER BY subCat";
		          $result=mysql_query($sql); 
			      return $result;	
	}
	public function getRating($storeid)
	{
                  $sql = "SELECT overallStars from storereviews where storeID ='$storeid'";
				 // $sql= "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCat_SubcatDetail($category,$subCat)
	{
                  $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.storeID = storereviews.storeID AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
				 // $sql= "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCat_SubSubcatDetail($category,$subCat)
	{
                  $sql = "SELECT distinct subSubCat FROM books where category='$category' AND subCat='$subCat' ORDER BY subSubCat"; 
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getSubSubcatDetail($subSubCat)
	{
                  //$sql = "SELECT * FROM books,stores where category='$category' AND subCat='$subCat' group by stores.storeName";
				  $sql= "SELECT * FROM books WHERE subSubCat='$subSubCat'";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getLoginDetail($emailAddress,$password)
	{
                  $sql = "SELECT * FROM customers where emailAddress='$emailAddress' AND password='$password'";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function insertSignUpDetail($firstName,$lastName,$emailAddress,$password) 
	{
         $sql = "INSERT INTO customers(firstName,lastName,emailAddress,password) VALUES ('$firstName','$lastName','$emailAddress','$password')";	
		$result=mysql_query($sql);
		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	public function CheckMail($emailAddress)
	{
                  $sql = "SELECT * FROM customers where emailAddress='$emailAddress'";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function ChngePasswordDetail($user1,$oldpwd,$newpwd,$repwd)
	{
                  $sql = "UPDATE customers SET password = '$newpwd' WHERE emailAddress = '$user1' and password = '$oldpwd'";
		          $result=mysql_query($sql);
			      return $result;	
	}
	  
  public function updateTempPass($emailAddress) {
	  
	          $length=8;
              $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
              $pass = substr( str_shuffle($chars ), 0, $length );
			  $sql = "UPDATE customers SET password = '$pass' WHERE  emailAddress = '$emailAddress'";
		      $result=mysql_query($sql);
			  return $result;
              		  
  }
    public function AddTocart($isbn,$quantity) {
		   
	          $qty = $quantity;
			  $sql = "UPDATE inventory SET quantity = quantity- '$qty' WHERE isbn = '$isbn'";
			  echo $sql;
		      $result=mysql_query($sql);
			  return $result;
              		  
  }
  public function getStoreDetail($storeName) 
  {
				 //$sql= "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.storeName='$storeName' GROUP BY stores.storeName";
				    $sql="SELECT * ,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books, storereviews WHERE stores.storeID = storereviews.storeID AND stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.storeName = '$storeName' GROUP BY stores.storeName";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getTitleDetail($title) 
    {
				  $sql= "SELECT * FROM books WHERE title ='$title'";
		          $result=mysql_query($sql);
			      return $result;	
	}
	
	
	public function getStateWiseStoreDetail($type,$typeno,$state,$city)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCategorySubcatWiseStoreDetail($type,$typeno,$category,$subCat)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat'  GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review  FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = " SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCategoryWiseBookANDStoreDetail($type,$typeno,$category)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review  FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = " SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	   public function getOnlyStateCityZipcodeDetail($state,$city)
	     {
                 // $sql = "SELECT zip,count(storeName) as total_store FROM stores where state='$state' AND city='$city'";
				  $sql="SELECT m.zip, (SELECT COUNT( storeName )FROM stores WHERE zip = m.zip) AS No_of_store FROM stores m WHERE state = '$state' AND city = '$city'";
		          $result=mysql_query($sql);
			      return $result;	
	     }
		 public function getstorenamedetail($zip) 
          {
				  $sql= "SELECT * FROM stores  WHERE zip ='$zip'";
		          $result=mysql_query($sql);
			      return $result;	
       	}
	   public function getcatagorywisedetail($zip) 
         {
				 $sql= "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.zip='$zip' GROUP BY stores.storeName";
		          $result=mysql_query($sql);
			      return $result;	
       	}
		 public function getOnlyCategorySubcatZipcodeDetail($category,$subCat)
	     {
				 // $sql="SELECT m.zip, (SELECT COUNT( storeName )FROM stores WHERE zip = m.zip) AS No_of_store FROM stores m WHERE state = '$state' AND city = '$city'";
				    $sql="SELECT distinct m.zip, (SELECT COUNT(storeName )FROM stores WHERE zip = m.zip) AS No_of_store  FROM stores m, books b,inventory i WHERE (b.category = '$category' AND b.subCat = '$subCat') AND (b.isbn = i.isbn) AND (i.storeID=m.storeID)";
		          $result=mysql_query($sql);
			      return $result;	
	     }
		 public function getStoreAssociationsDetail($storeName)
	     {
                  $sql = "SELECT motherStore FROM storeassociations where storeName='$storeName'";
		          $result=mysql_query($sql);
			      return $result;	
	     }
		 public function getNumberOfBookDetail($storeName)
	     {
				 $sql = "SELECT books.category AS Category, books.subCat As SubCategory, COUNT( books.isbn ) As No_of_books FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	     }
		 public function getNoOfReviewDetail($storeName)
	     {
				 $sql = "select * from storereviews,stores where stores.storeID = storereviews.storeID AND stores.storeName='$storeName'";
				  $result=mysql_query($sql);
			      return $result;	
	     }
		   public function getNumberOfBookByCategoryDetail($storeName) 
           {
			      $sql="SELECT books.category AS Category, COUNT( books.isbn ) As No_of_books FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		  public function getNumberOfBookBySubCategoryDetail($storeName,$category) 
          {
			      //$sql="SELECT books.subCat AS SubCategory, COUNT( books.isbn ) As No_of_books FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND books.category='$category' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $sql="SELECT b.category,b.subCat AS SubCategory, (SELECT COUNT(isbn )FROM books WHERE subCat = b.subCat) AS No_of_books  FROM books b,stores m,inventory i WHERE (b.category = '$category' AND m.storeName = '$storeName') AND (b.isbn = i.isbn) AND (i.storeID=m.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		   public function getBookByCat_SubCategoryDetail($storeName,$category,$subCat) 
          {
			      $sql="SELECT books.* FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND books.category='$category' AND books.subCat='$subCat' AND(books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
}