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
				  //$sql ="SELECT stores.*,books.*,storereviews.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn  AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
				  $sql = "SELECT stores.*,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores,books,storereviews WHERE stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
				  $result=mysql_query($sql);
			      return $result;
	}
	public function getCategoryDetail()
	{
                  $sql = "SELECT distinct category FROM  books ORDER BY category";
				    //$sql = "SELECT distinct category FROM  category ORDER BY category";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getOnlyCategoryDetail($category)
	{
                  $sql = "SELECT * FROM books WHERE category='$category'";
		          $result=mysql_query($sql); 
			      return $result;	
	}
	public function getSubCategoryDetail1($category,$subCat)
	{
                //  $sql = "SELECT distinct subCat FROM books where category='$category' ORDER BY subCat";
				    $sql = "select count(stores.storeName) as no_of_store from stores,books,inventory where books.category ='$category' AND books.subCat='$subCat' AND stores.storeID=inventory.storeID AND books.isbn = inventory.isbn ";
		          $result=mysql_query($sql); 
			      return $result;	
	}
	public function getSubCategoryDetail($category)
	{
                   $sql = "SELECT distinct subCat,category FROM books where category='$category' ORDER BY subCat";
				   // $sql = "SELECT distinct b.subCat,(SELECT COUNT(isbn)FROM books WHERE subCat = b.subCat) AS No_of_stores from books b where b.category='$category' ORDER BY subCat";
		          $result=mysql_query($sql); 
			      return $result;	
	}
	public function getRating($storeid)
	{
                  $sql = "SELECT sum( overallStars ) / count( overallStars ) AS rating from storereviews where storeID ='$storeid'";
				 // $sql= "SELECT * FROM stores, inventory, books WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCat_SubcatDetail($category,$subCat)
	{
                  $sql = "SELECT stores.*,books.*,storereviews.*,inventory.*,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn  AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
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
		 $joinDate1 = date('Y-m-d');
         $sql = "INSERT INTO customers(firstName,lastName,emailAddress,password,insertDate) VALUES ('$firstName','$lastName','$emailAddress','$password','$joinDate1 ')";	
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
			  //echo $sql;
		      $result=mysql_query($sql);
			  return $result;
              		  
  }
   public function getStoreDetail($storeName) 
   {
				
				//$sql="SELECT * from stores where storeName='$storeName'";
				$sql= "SELECT stores.*,books.*,storereviews.*,inventory.*,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn  AND stores.storeName='$storeName' GROUP BY stores.storeName";
				 // $sql="SELECT * ,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books, storereviews WHERE stores.storeID = storereviews.storeID AND stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.storeName = '$storeName' GROUP BY stores.storeName";
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
					// $sql = "SELECT stores.*,books.*,storereviews.*,inventory.*,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
				 }else if($type=="title"){
				 
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					 
					 //$sql = "SELECT *,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND stores.state='$state' AND stores.city='$city' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCategorySubcatWiseStoreDetail($type,$typeno,$category,$subCat)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat'  GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review  FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = " SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND books.category='$category' AND books.subCat='$subCat' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	}
	public function getCategoryWiseBookANDStoreDetail($type,$typeno,$category)
	{
		         if($type=="isbn")
				 {
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.isbn like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					 
				 }else if($type=="title"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review  FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.title like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					
				 } else if($type=="author"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql = " SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.author like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					
				 } else if($type=="callNum"){
					  //$sql = "SELECT * FROM books where callNum='$typeno'";
					  $sql = "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND books.callNum like '%$typeno%' AND books.category='$category' GROUP BY stores.storeName";
					 
				 }
		          $result=mysql_query($sql);
			      return $result;	
	     }
	     public function getOnlyStateCityZipcodeDetail($state,$city)
	     {
                 // $sql = "SELECT zip,count(storeName) as total_store FROM stores where state='$state' AND city='$city'";
				  $sql="SELECT distinct m.zip, (SELECT COUNT( storeName )FROM stores WHERE zip = m.zip) AS No_of_store FROM stores m WHERE state = '$state' AND city = '$city'";
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
				 $sql= "SELECT stores.*,books.*,inventory.quantity,(select count(COMMENT) from storereviews where storeID = stores.storeID)As No_of_Review FROM stores, inventory, books,storereviews WHERE stores.storeID = inventory.storeID AND inventory.isbn = books.isbn AND stores.zip='$zip' GROUP BY stores.storeName";
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
				 $sql= "select stores.storeID,stores.storeName,customers.firstName,customers.lastName,storereviews.*,storereviews.overallStars as mystar,(select count(COMMENT) from storereviews where storeID = stores.storeID) As No_of_Review from stores,storereviews,customers where stores.storeID = storereviews.storeID AND storereviews.custID=customers.custID AND stores.storeName='$storeName'";
				  $result=mysql_query($sql);
			      return $result;	
	     }
		 public function getNumberOfBookByCategoryDetail($storeName) 
         {
			      $sql="SELECT distinct books.category AS Category,stores.storeName FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		   public function getNumberOfBookByCategoryDetail_1($storeName,$category)
           {
			      $sql="SELECT books.category AS Category,COUNT( books.isbn ) As No_of_books FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND books.category='$category' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	 
	      }
		  public function getNumberOfBookBySubCategoryDetail($storeName,$category)
          {
			      //$sql="SELECT books.category,books.subCat AS SubCategory ,COUNT( books.isbn ) As No_of_books FROM books, stores, inventory WHERE books.category='$category' AND stores.storeName = '$storeName' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				 // $sql="SELECT b.category,b.subCat AS SubCategory, (SELECT COUNT(isbn)FROM books WHERE subCat = b.subCat) AS No_of_books  FROM books b,stores m,inventory i WHERE (b.category = '$category' AND m.storeName = '$storeName') AND (b.isbn = i.isbn) AND (i.storeID=m.storeID)";
				    $sql="SELECT b.category,b.subCat AS SubCategory ,m.storeName FROM books b,stores m,inventory i WHERE (b.category = '$category' AND m.storeName = '$storeName') AND (b.isbn = i.isbn) AND (i.storeID=m.storeID)";
				    $result=mysql_query($sql);
			        return $result;	
	      }
		  public function getNumberOfBookBySubCategoryDetail_1($storeName,$category,$SubCategory)
          {
			      $sql="SELECT count(b.isbn) As No_of_books FROM books b,stores s,inventory i WHERE s.storeName = '$storeName' AND b.category='$category' AND b.subCat='$SubCategory' AND (b.isbn = i.isbn) AND (i.storeID=s.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		   public function getBookByCat_SubCategoryDetail($storeName,$category,$subCat) 
          {
			      $sql="SELECT books.*,stores.storeName,inventory.quantity FROM books, stores, inventory WHERE stores.storeName = '$storeName' AND books.category='$category' AND books.subCat='$subCat' AND(books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		  public function getbookDetailByStore_catWise($storeName,$category) 
          {
			      $sql="SELECT books.*,stores.storeName,inventory.quantity FROM books, stores, inventory WHERE books.category='$category' AND stores.storeName = '$storeName' AND (books.isbn = inventory.isbn) AND (inventory.storeID = stores.storeID)";
				  $result=mysql_query($sql);
			      return $result;	
	      }
		  public function insertReviewHelp($storeName,$comment,$HelpFull)
		  { 
		       $storeID = $storeName; 
		      // $start_time = date('Y-m-d H:i:s');
		       $strcomment =  htmlspecialchars($comment, ENT_QUOTES);
			 //$strcomment = htmlspecialchars($comment, ENT_COMPAT);
			   if($HelpFull==1)
			   {
				    $sql="INSERT INTO storereviews(storeID,comment,helpful,reviewTime) SELECT storeID, '$strcomment', '$HelpFull', NOW() FROM stores WHERE storeName = '$storeName'";
					
			   }
			   else 
			   {
				     $sql="INSERT INTO storereviews(storeID,comment,noHelp,reviewTime) SELECT storeID, '$strcomment', '$HelpFull', NOW() FROM stores WHERE storeName = '$storeName'";
					 
			   }
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
		  public function getOnlyStoreNameDetail($storeName)
		  {
			      $sql="SELECT Distinct storeName FROM stores WHERE storeName like '%$storeName%'";
				  $result=mysql_query($sql);
			      return $result;	
		  }
		  public function getBookListBorrowDetail($type,$storeName,$b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10) 
	      {
		         if($type=="isbn")  
				 {
					 $sql="SELECT books.*,stores.*,inventory.* FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storeName' and (books.isbn ='$b1' || books.isbn ='$b2' || books.isbn ='$b3' || books.isbn ='$b4' || books.isbn ='$b5' || books.isbn ='$b6' || books.isbn ='$b7' || books.isbn ='$b8' || books.isbn ='$b9' || books.isbn ='$b10')";
					 
				 }else if($type=="callNum"){
				 
					 //$sql = "SELECT * FROM books where title='$typeno'";
					 
					 $sql="SELECT books.*,stores.*,inventory.* FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storeName' and (books.callNum ='$b1' || books.callNum ='$b2' || books.callNum ='$b3' || books.isbn ='$b4' || books.callNum ='$b5' || books.callNum ='$b6' || books.callNum ='$b7' || books.callNum ='$b8' || books.callNum ='$b9' || books.callNum ='$b10')";
					
				 } else if($type=="privateCallNum"){
					//$sql = "SELECT * FROM books where author='$typeno'";
					 $sql="SELECT books.*,stores.*,inventory.* FROM stores,inventory,books WHERE stores.storeId=inventory.storeId and inventory.isbn=books.isbn and stores.storeName='$storeName' and (inventory.privateCallNum ='$b1' || inventory.privateCallNum ='$b2' || books.callNum ='$b3' || inventory.privateCallNum ='$b4' || inventory.privateCallNum ='$b5' || inventory.privateCallNum ='$b6' || books.callNum ='$b7' || inventory.privateCallNum ='$b8' || inventory.privateCallNum ='$b9' || inventory.privateCallNum ='$b10')";
					
				 }
		          $result=mysql_query($sql);
			      return $result;	
	      }
		  public function GetTrasactiondetail($DateType,$custID) 
	      {
		         if($DateType=="ALL")  
				 {
					 $sql="SELECT * FROM  transactions where custID='$custID'";
					 
				 }else if($DateType=="Quarterly"){
				 
					 $sql="SELECT * FROM  transactions WHERE transTime BETWEEN (CURRENT_DATE() - INTERVAL 3 month) AND CURRENT_DATE() AND custID='$custID'";
					
				 } else if($DateType=="Monthly"){
				
					 $sql="SELECT * FROM  transactions WHERE transTime BETWEEN (CURRENT_DATE() - INTERVAL 1 MONTH) AND CURRENT_DATE() AND custID='$custID'";
					
				 }else if($DateType=="Annually"){ 
					 
					 $sql="SELECT * FROM  transactions WHERE transTime BETWEEN (CURRENT_DATE() - INTERVAL 1 year) AND CURRENT_DATE() AND custID='$custID'";
					
				 }
		          $result=mysql_query($sql);
		 	      return $result;	
	       }
		   public function DatewiseGetDataforTrans($from_date,$to_date,$custID) 
           {
			      $sql="SELECT * FROM  transactions WHERE transTime BETWEEN '$from_date' AND '$to_date' AND custID='$custID'";
				  $result=mysql_query($sql);
			      return $result;	
	       }
		   public function GetIdwiseTransactionDetail($tid) 
           {
			      $sql="SELECT * FROM  transactions WHERE tid='$tid'";
				  //$sql="SELECT * FROM  transactions WHERE tid='$tid'";
				  $result=mysql_query($sql);
			      return $result;	
	       }
		   public function GetLineItemDetail($tid) 
           {
			      $sql="SELECT * FROM  lineitems WHERE tid='$tid'";
				  //$sql="SELECT * FROM  transactions WHERE tid='$tid'";
				  $result=mysql_query($sql);
			      return $result;	
	       }
		   public function updateProfile($firstName,$middleName,$lastName,$addrStNum,$addrL2,$city,$state,$zip,$otherPhone,$telephoneNumber,$cardNumber,$cardType,$cardExp,$cardCode,$cardName,$billingAddr,$homeLib,$emailAddress) 
		   {		   	         
			  $sql = "UPDATE customers SET firstName = '$firstName', middleName = '$middleName', lastName = '$lastName', addrStNum = '$addrStNum',addrL2 = '$addrL2', city = '$city', state = '$state', zip = '$zip',otherPhone = '$otherPhone', telephoneNumber = '$telephoneNumber', cardNumber = '$cardNumber', cardType= '$cardType', cardExp = '$cardExp', cardCode = '$cardCode', cardName = '$cardName', billingAddr='$billingAddr', homeLib = '$homeLib' WHERE emailAddress = '$emailAddress'";
		      //echo $sql;
			  $result=mysql_query($sql);
			  return $result; 
              		  
           }
		   public function gethomLibDetail($emailAddress)
	       {
				  $sql = "SELECT homeLib FROM customers WHERE emailAddress ='$emailAddress'";
		          $result=mysql_query($sql); 
			      return $result;	
	       }
		   public function getLookupDirecyoryDetail($type)
	       {
			   if($type=="Organizations Name")
			   {
				  $sql = "SELECT name,cname,telephoneNumber,pastor,addrStNum,state,city from  organizations ";
				 
			   }
			     $result=mysql_query($sql);
			    return $result;	
	        }
			public function GetOrganizationDetail($type,$typeno)
	        {
				
		         if($type=="Organizations Name")  
				 {
					 $sql="select * from organizations where name='$typeno'";
					 
				 }else if($type=="Optional Organizations Name"){
				 
					 $sql="select * from organizations where cname='$typeno'";
					
				 } else if($type=="Pastor Name"){
				
					 $sql="select * from organizations where pastor='$typeno'";
					
				 }else if($type=="Optional Pastor Name"){
					 
					 $sql="select * from organizations where cpastor='$typeno'";
					
				 }
		          $result=mysql_query($sql);
		 	      return $result;	
	       }
		   public function GetOrganizationDetailBystate($type)
	        {
				if($type == "ALL")
				{
					
				    $sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations";
				} 
				else if($type == "NC")  
				{
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations where state='NC'";
				} 
				else if($type == "VA")
				{
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations where state='VA'";
				}
				else if($type == "NJ")
				{
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations where state='NJ'";
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }
			 public function getDirectoryDetailByName($name)
	         {
				  $sql = "SELECT * from organizations where name='$name'";
		          $result=mysql_query($sql); 
			      return $result;	
	         }
			 public function getBranchDetailByName($name)
	         {
				  $sql = "SELECT branches.* FROM branches, organizations WHERE organizations.name = '$name' AND branches.organID = organizations.organID";
		          $result=mysql_query($sql); 
			      return $result;	
	         }
			 public function getBranchDetailByID($BranchID)
	         {
				  $sql = "SELECT branches.* FROM branches WHERE branchID='$BranchID'";
		          $result=mysql_query($sql); 
			      return $result;	
	         }
			 public function GetOrganizationDetailBystateANDCity($state,$city)
	        {
				if($state == "NC")
				{
				    $sql="select * from organizations where city='$city'";
				} 
				else if($state == "VA")
				{
					$sql="select * from organizations where city='$city'";
				}
				else if($state == "NJ")
				{
					$sql="select * from organizations where city='$city'";
				}
				else if($state == "ALL")
				{
					$city=0;
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations";
				}
				
				  $result=mysql_query($sql);
			      return $result;	
	        }
			 public function GetOrganizationsSerchByname($type)
	        {
				
				if($type == "ALL") 
				{
				    $sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations";
				} 
				else if($type == "Church")  
				{
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations where type like '%Church%'";
				} 
				else if($type == "Organizations")  
				{
					$sql="select name,cname,telephoneNumber,pastor,addrStNum,state,city from organizations where type like '%Organizations%'";
				
				} 
				 $result=mysql_query($sql);
			      return $result;	
	        }
			public function CheckMailforMemberShip($custID,$storeName)
	        {
                  $sql = "SELECT * FROM  libmembers where custID='$custID' AND storeName='$storeName'";
		          $result=mysql_query($sql);
			      return $result;	
	        }
            public function insertMembershipDataforapply($custID,$storeName) 
	        {
			    $joinDate1 = date('Y-m-d');
				$length=5;
		        $chars = "123456789";
                $barcode1 = substr( str_shuffle( $chars ), 0, $length );
				$activate1=0;
				$status1="created";
				$sql = "INSERT INTO libmembers(storeId,custFirstName,custLastName,custID,storeName,joinDate,barcode,activate,status)SELECT storeID,customers.firstName,customers.lastName, '$custID', '$storeName', '$joinDate1','$barcode1','$activate1','$status1' FROM stores,customers WHERE stores.storeName = '$storeName'  AND customers.custID='$custID'";
				$result=mysql_query($sql);
				return $result;		
	         	
			}
            public function insertMembershipData($custID,$storeName,$pin) 
	        {
			    $joinDate1 = date('Y-m-d');
				$length=5;
		        $chars = "123456789";
                $barcode1 = substr( str_shuffle( $chars ), 0, $length );
				$activate1=0;
				$status1="created";
				$sql = "INSERT INTO libmembers(storeId,custFirstName,custLastName,custID,storeName,joinDate,barcode,pin,activate,status)SELECT stores.storeID,customers.firstName,customers.lastName, '$custID', '$storeName', '$joinDate1','$barcode1','$pin','$activate1','$status1' FROM stores,customers WHERE stores.storeName = '$storeName' AND customers.custID='$custID'";
				$result=mysql_query($sql);
				 return $result;		
	         	
			}
			public function getmembershipDetail($custID) 
            {
				  $sql= "SELECT * FROM libmembers WHERE custID ='$custID'";
		          $result=mysql_query($sql);
			      return $result;	
	        }
			 public function GetOrganizationDetailBystateANDCityANDType($state,$city,$type)
	         {
				if($state == "NC")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where city='$city'";
					
					}
					if($type=="Church")
					{
						$sql="select * from organizations where city='$city' AND type like '%Church%'";
					
					}
					if($type=="Organizations")
					{
						$sql="select * from organizations where city='$city' AND type like '%Organizations%'";
					
					}					
				    
				} 
				else if($state == "VA")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where city='$city'";
					
					}
					if($type=="Church")
					{
						$sql="select * from organizations where city='$city' AND type like '%Church%'";
					
					}
					if($type=="Organizations")
					{
						$sql="select * from organizations where city='$city' AND type like '%Organizations%' ";
					
					}					
				}
				else if($state == "NJ")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where city='$city'";
					
					}
					if($type=="Church")
					{
						$sql="select * from organizations where city='$city' AND type like '%Church%'";
					
					}
					if($type=="Organizations")
					{
						$sql="select * from organizations where city='$city' AND type like '%Organizations%'";
					
					}					
				}
			    else if($state == "ALL")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where city='$city'";
					
					}
					if($type=="Church")
					{
						$sql="select * from organizations where city='$city' AND type like '%Church%'";
					
					}
					if($type=="Organizations")
					{
						$sql="select * from organizations where city='$city' AND type like '%Organizations%'";
					
					}					
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }
			  public function SerchByAllOrganizationDetail($state,$city,$type,$name,$namevalue)
	         {
				if($state == "NC")
				{
					if($name=="Organizations Name")
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND name='$namevalue'";
					    }
					
					}
					else if($name=="Optional Organizations Name")
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cname='$namevalue'";
					    }
					}
					else if($name=="Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND pastor='$namevalue'";
					    }
					
					}	
                   else if($name=="Optional Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cpastor='$namevalue'";
					    }
					
					}								
				    
				} 
				else if($state == "NJ")
				{
			     
					  if($name=="Organizations Name")
					  {
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND name='$namevalue'";
					    }
					
					}
					else if($name=="Optional Organizations Name")
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cname='$namevalue'";
					    }
					}
					else if($name=="Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND pastor='$namevalue'";
					    }
					
					}	
                   else if($name=="Optional Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cpastor='$namevalue'";
					    }
					
					}								
				    
				  
				}
				else if($state == "VA")
				{
				
					  if($name=="Organizations Name")
					  {
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND name='$namevalue'";
					    }
					
					}
					else if($name=="Optional Organizations Name")
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cname='$namevalue'";
					    }
					}
					else if($name=="Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND pastor='$namevalue'";
					    }
					
					}	
                    else if($name=="Optional Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cpastor='$namevalue'";
					    }
					
					}								
				    
				  
				}
			    else if($state == "ALL")
				{
				    if($name=="Organizations Name")
					  {
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND name='$namevalue'";
					    }
					
					}
					else if($name=="Optional Organizations Name")
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cname='$namevalue'";
					    } 
					}
					else if($name=="Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND pastor='$namevalue'";
					    }
					
					}	
                   else if($name=="Optional Pastor Name")  
					{
						if($type=="ALL" || $type=="Church" || $name=="Organizations")
						{
						   $sql="select * from organizations where city='$city' AND cpastor='$namevalue'";
					    }
					
					}								
				    
				   
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }	
			public function getOrganizationNamebytype($name,$namevalue,$type)
	         {
				if($name == "Organizations Name")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where name='$namevalue'";
					
					}
					else if($type=="Church")
					{
						$sql="select * from organizations where name='$namevalue' AND type like '%Church%'";
					
					}
					else if($type=="Organizations")
					{
						$sql="select * from organizations where name='$namevalue' AND type like '%Organizations%'";
					
					}					
				    
				} 
				else if($name == "Optional Organizations Name")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where cname='$namevalue'";
					
					}
					else if($type=="Church")
					{
						$sql="select * from organizations where cname='$namevalue' AND type like '%Church%'";
					
					}
					else if($type=="Organizations")
					{
						$sql="select * from organizations where cname='$namevalue' AND type like '%Organizations%'";
					
					}					
				}
				else if($name == "Pastor Name")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where pastor='$namevalue'";
					
					}
					else if($type=="Church")
					{
						$sql="select * from organizations where pastor='$namevalue' AND type like '%Church%'";
					
					}
					else if($type=="Organizations")
					{
						$sql="select * from organizations where pastor='$namevalue' AND type like '%Organizations%'";
					
					}					
				}
			    else if($name == "Optional Pastor Name")
				{
					if($type=="ALL")
					{
						$sql="select * from organizations where cpastor='$namevalue'";
					
					}
					else if($type=="Church")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND type like '%Church%'";
					
					}
					else if($type=="Organizations")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND type like '%Organizations%'";
					
					}					
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }
			public function getOrganizationNamebystate1($name,$namevalue,$state)
	         {
				if($state == "NC")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue'";
					
					}							
				    
				} 
				else if($state == "NJ")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue'";
					
					}							
				}
				else if($state == "VA")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue'";
					
					}							
				}
			    else if($state == "ALL")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue'";
					
					}							
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }
			public function getOrganizationNamebystateANDCity($name,$namevalue,$state,$city)
	         {
				if($state == "NC")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue' AND city='$city'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND city='$city'";
					
					}							
				    
				} 
				else if($state == "NJ")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue' AND city='$city'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND city='$city'";
					
					}							
				}
				else if($state == "VA")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue' AND city='$city'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND city='$city'";
					
					}							
				}
			    else if($state == "ALL")
				{
					if($name=="Organizations Name")
					{
						$sql="select * from organizations where name='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Optional Organizations Name")
					{
						$sql="select * from organizations where cname='$namevalue' AND city='$city'";
						
					
					}
					else if($name=="Pastor Name")
					{
						$sql="select * from organizations where pastor='$namevalue' AND city='$city'";
					
					}
                    else if($name=="Optional Pastor Name")
					{
						$sql="select * from organizations where cpastor='$namevalue' AND city='$city'";
					
					}							
				}
				  $result=mysql_query($sql);
			      return $result;	
	        }
			public function GetActiveOrderDetail($custID) 
            {
				  $sql= "SELECT * FROM activeorders WHERE custID ='$custID'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function GetOutItemDetail($custID)
             {
				  $status1=1;
				  $type="borrow";
				  $sql= "SELECT * FROM outitems WHERE custID ='$custID' AND status='$status1' and type='$type'";
			 
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function GetProfileDetail1($firstName,$middleName,$lastName,$addrStNum,$addrL2,$city,$state,$zip,$otherPhone,$telephoneNumber,$cardNumber)
	         {
                  $sql = "SELECT * FROM customers WHERE firstName = '$firstName' AND middleName = '$middleName' AND lastName = '$lastName' AND addrStNum = '$addrStNum' AND addrL2 = '$addrL2' AND city = '$city' AND state = '$state' AND zip = '$zip' AND otherPhone = '$otherPhone' AND telephoneNumber = '$telephoneNumber' AND cardNumber = '$cardNumber'";
		          //echo $sql;
				  $result=mysql_query($sql); 
			      return $result;	
	         }
			  public function GetCustomerDetail($emailAddress)
             {
				  $sql= "SELECT * FROM customers WHERE emailAddress ='$emailAddress'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			  public function Checkholdit($storeName,$isbn)
	         {
                  $sql = "SELECT * FROM hold_it where storeName='$storeName' AND isbn='$isbn'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			   public function Checkholdit1($storeName,$isbn,$custID)
	         {
                  $sql = "SELECT * FROM hold_it where storeName='$storeName' AND isbn='$isbn' AND custID='$custID'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function insertHolditDetail($storeName,$custID,$title,$isbn)
		     { 
			    
				 $holdit_time = date('Y-m-d H:i:s');
				 $sql="INSERT INTO hold_it(storeName,custID,title,isbn,HoldDate,DueHold)values('$storeName','$custID','$title','$isbn','$holdit_time','$custID')";
				     
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
			 public function insertHolditDetail1($storeName,$custID,$title,$isbn)
		     {
					 //$holdit_time = "select NOW()";
                     $sql="INSERT INTO hold_it(storeName,custID,title,isbn,HoldDate,Holdit)values('$storeName','$custID','$title','$isbn',NOW(),'$custID')"; 
				  
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
			 public function insertactiveDetail($storeName,$custID,$title)
		     { 
		        $storeID = $storeName;
		        //$transTime = date('Y-m-d H:i:s');
				$orderStatus = "ordered";
				$type ="borrow";
				$sql="INSERT INTO activeorders(storeID,storeName,custID,title,transTime,type,orderStatus) SELECT storeID,'$storeName','$custID','$title',NOW(),'$type','$orderStatus' FROM stores WHERE storeName = '$storeName'";
			   
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
			 public function updateActiveOrder($tid) 
             {
				  $sql= "update activeorders set orderStatus='Received' where tid = '$tid'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function AddTranDetail($tid) 
             {
				
				  $sql= "INSERT INTO `transactions`(`storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `transTime`, `numberOfLines`, `unitsOrdered`, `title`, `type`, `subTot`, `taxRatePercent`, `taxAmount`, `discountPercentage`, `shipFee`, `totPrice`, `receiverName`, `shippingAddr`, `shipMethod`, `deliveryTimeCode`, `carrierName`, `deliveryNotes`, `orderStatus`, `msgToCust`, `msgToStore`, `agentName`, `notes`) select `storeID`, `storeName`, `custID`, `custFirstName`, `custLastName`, `transTime`, `numberOfLines`, `unitsOrdered`, `title`, `type`, `subTot`, `taxRatePercent`, `taxAmount`, `discountPercentage`, `shipFee`, `totPrice`, `receiverName`, `shippingAddr`, `shipMethod`, `deliveryTimeCode`, `carrierName`, `deliveryNotes`, `orderStatus`, `msgToCust`, `msgToStore`, `agentName`, `notes` from activeorders where tid = '$tid'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function DeleteActiveorderID($tid) 
             {
				  $sql= "delete from activeorders where tid = '$tid'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function updateMessTostore($tid,$store_message) 
             {
				  $sql= "update activeorders set msgToStore='$store_message' where tid = '$tid'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			  public function insertStoreReviewHelp($storeName,$cust_id,$subject,$quality,$speed,$overallstars,$comment)
		      { 
		            $storeID = $storeName; 	
                   // $reviewTime = date('Y-m-d H:i:s');					
				    $sql="INSERT INTO storereviews(storeID,custID,revTitle,quality,speed,overallStars,reviewTime,comment) SELECT storeID, '$cust_id','$subject','$quality','$speed','$overallstars',NOW(),'$comment' FROM stores WHERE storeName = '$storeName'";			
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
			 public function updateholditID($store,$isbn,$custid)
             {
				  $sql= "update inventory i,stores s set i.holderID ='$custid', i.holdDate = now(),s where storeName='$store' and isbn='$isbn'";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			 public function getquantity($custID)
             {
				  $sql= "SELECT i.quantity,h.storeName,h.title,h.isbn,min(h.HoldDate) as HoldDate FROM inventory i, hold_it h WHERE h.storeName = i.storeName AND h.isbn = i.isbn AND h.custID = '$custID' AND h.Holdit = '$custID' AND Holdit>0";
		         //echo $sql;
				  $result=mysql_query($sql);
			      return $result;	
	         }
			 public function getHoldDateTimeDetail($storeName,$isbn)
             {
				  $sql= "SELECT min(h.HoldDate) as HoldDate,DueHold FROM inventory i, hold_it h WHERE h.storeName = i.storeName AND h.isbn = i.isbn AND h.storeName='$storeName' and h.isbn='$isbn' AND DueHold>0";
		          $result=mysql_query($sql);
			      return $result;	
	         }
			  public function updateHolditDetail($custID,$storeName,$isbn)
             {
				  $sql= "update inventory i,hold_it h set h.Holdit ='0' where h.storeName='$storeName' and h.isbn='$isbn' and h.custID='$custID'";
		         
				  $result=mysql_query($sql);
			      return $result;	
	         }
			  public function updateDueHoldDetail($storeName,$isbn,$HoldDate,$DueHold)
              {				 
				  $sql= "update inventory i,hold_it h set h.Holdit ='$DueHold',h.DueHold='0' where h.storeName='$storeName' and h.isbn='$isbn' and h.HoldDate='$HoldDate'";
		          $result=mysql_query($sql);
			      return $result;
                 
                  				  
	         }
			 public function getbookReviewdetail($isbn,$bookTitle,$custID,$overallStars,$comment,$helpful)
	         {
				 // $reviewTime = date('Y-m-d H:i:s');
		          $strcomment =  htmlspecialchars($comment, ENT_QUOTES);
				  if($helpful==1)
			      {
                    $sql="INSERT INTO bookreviews(isbn,bookTitle,custID,overallStars,comment,helpful,reviewTime) VALUES('$isbn','$bookTitle','$custID','$overallStars','$strcomment','$helpful',NOW())";			
			        
				   }
			       else 
			       {
					     $sql="INSERT INTO bookreviews(isbn,bookTitle,custID,overallStars,comment,noHelp,reviewTime) VALUES('$isbn','$bookTitle','$custID','$overallStars','$strcomment','$helpful',NOW())";			
				   }
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
			 public function updateoutdateDetail($custID,$storeName,$isbn,$dueDate)
              {				 
				  $sql= "update outitems set outDate ='$dueDate' where storeName='$storeName' and isbn='$isbn' and custID='$custID'";
		          $result=mysql_query($sql);
			      return $result;
                 
                  				  
	         }
			  public function updateDuedateDetail($custID,$storeName,$isbn,$dueDate)
              {
				  $sql= "UPDATE outitems SET dueDate = DATE_ADD('$dueDate', INTERVAL 6 DAY),renewCount=renewCount+1  where storeName='$storeName' and isbn='$isbn' and custID='$custID'"; 
				  $result=mysql_query($sql);
			      return $result;
                 
                  				   
	         }
			  public function updatestatusDetail($custID,$storeName,$isbn)
              {
				  $sql= "UPDATE outitems SET status='0' where storeName='$storeName' and isbn='$isbn' and custID='$custID'";
				  $result=mysql_query($sql);
			      return $result;
                 
                  				   
	         }
			 public function insertboorwtrans($storeName,$custID,$title)
		     { 
		        $storeID = $storeName;
		        //$transTime = date('Y-m-d H:i:s');
				$type ="borrow";
				$sql="INSERT INTO transactions(storeID,storeName,custID,title,transTime,type) SELECT storeID,'$storeName','$custID','$title',NOW(),'$type' FROM stores WHERE storeName = '$storeName'";
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
			  public function getisbnbytitle($title)
              {
				  $sql= "select isbn from books where title = '$title'";
			
				   
		          $result=mysql_query($sql);
			      return $result;	
	          }
			   public function checkbookavailable($qty,$title,$storename)
              {
				  $sql= "select * from inventory where isbn = '$title' and quantity > 0 and storeName='$storename'";
			      $result=mysql_query($sql);
			      return $result;
			    
			 
			}
			   public function checkbookavailablebycallnum($qty,$title,$storename)
              {
				  $sql= "select * from inventory where privateCallNum = '$title' and quantity > 0 and storeName='$storename'";
			      $result=mysql_query($sql);
			        return $result;
			}
			  public function updateQuantity($storeName,$isbn) {
		   
	         
			  $sql = "UPDATE inventory SET quantity = quantity- 1 WHERE isbn = '$isbn' AND storeName='$storeName'"; 
				
			  
		      $result=mysql_query($sql);
			  return $result;
			
             }
			  public function updateQuantitybyisbn($storeName,$isbn) {
		   
	         
			  $sql = "UPDATE inventory SET quantity = quantity- 1 WHERE isbn = '$isbn' AND storeName='$storeName'"; 
			  $result=mysql_query($sql);
			  if($result==true)
			  {
			    $sql1= "select * from inventory WHERE isbn = '$isbn' AND storeName='$storeName'";
			    $result1=mysql_query($sql1);
			    return $result1;	
			  
			  }
			  else
			  {
			  return $result;
			  }
			  }
			    public function updateQuantitybycallnum($storeName,$pvcallnum) {
		   
	         
			  $sql = "UPDATE inventory SET quantity = quantity- 1 WHERE privateCallNum = '$pvcallnum' AND storeName='$storeName'"; 
			  $result=mysql_query($sql);
			 if($result==true)
			  {
			    $sql1= "select * from inventory WHERE privateCallNum = '$pvcallnum' AND storeName='$storeName'";
			    $result1=mysql_query($sql1);
			    return $result1;	
			  
			  }
			  else
			  {
			  return $result;
			  }
			  }
			  public function gettransactionID()
              {
				   $sql= "SELECT * FROM transactions WHERE transTime = (SELECT MAX(transTime) FROM transactions)";
		          $result=mysql_query($sql);
			      return $result;
	          }
			  public function getlastinsertrecord()
              {
				   $sql= "SELECT * FROM transactions WHERE tid = (SELECT MAX(tid) FROM transactions)";
		          $result=mysql_query($sql);
			      return $result;
	          }
			  public function insertoutitemDetail($storeName,$custID,$isbn,$title,$tid,$transTime)
		     { 
		        $storeID = $storeName;
				$type ="borrow";
				$status =1;
				
				$sql="INSERT INTO  outitems(storeID,storeName,custID,isbn,title,tid,type,outDate,status) SELECT storeID,'$storeName','$custID','$isbn','$title','$tid','$type','$transTime','$status' FROM stores WHERE storeName = '$storeName'";
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
			  public function updateitemDuedate($custID,$storeName,$isbn,$tid,$transTime)
              {
				  $sql= "UPDATE outitems SET dueDate = DATE_ADD('$transTime', INTERVAL 6 DAY) where storeName='$storeName' and isbn='$isbn' and custID='$custID' AND tid='$tid'"; 
				 
				  $result=mysql_query($sql);
			      return $result;
                 
             }
			  public function getTransIdDetail($tid)
              {
				  $sql= "SELECT * FROM transactions WHERE tid='$tid'";
		          $result=mysql_query($sql);
			      return $result;
	          }
			  public function getisbn($tid)
              {
				  $sql= "SELECT * FROM books WHERE title='$tid'";
		          $result=mysql_query($sql);
			      return $result;
	          }
			  
			 public function insertoutitemDetail1($storeID,$storeName,$custID,$isbn,$title,$tid,$type,$transTime)
		     { 
			    
				$status =1;
				$date = strtotime("+6 day");
                $duedate=date('Y-m-d', $date);
				
				$sql="INSERT INTO outitems (storeID,storeName,custID,isbn,title,tid,type,outDate,dueDate,status) values('$storeID','$storeName','$custID','$isbn','$title','$tid','$type','$transTime','$duedate','$status')";
			
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
		      
}