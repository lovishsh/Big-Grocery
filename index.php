<?php
	session_start();
	//$_SESSION['copn_code']='';
	//$_SESSION['id']='';
	include 'header.php';
	include 'config.php';
	
	
	if(isset($_POST['insert']))
		{
			$p_id=$_POST['product_id'];
			$user_id=$_SESSION['id'];
			
			$sql="select * from favraite where user_id='$user_id' and product_id='$p_id'";
			$run=mysqli_query($con,$sql);
			$count=mysqli_num_rows($run);
			if($count > 0)
			{
				$fetch=mysqli_fetch_assoc($run);
				$id=$fetch['id'];
				$del_sql="delete from favraite where id='$id'";
				$qr=mysqli_query($con,$del_sql);	
			}
			else
			{
					$insert="insert into favraite(user_id,product_id)values('$user_id','$p_id')";
				$chk=mysqli_query($con,$insert);
				if($chk)
				{
					echo"<script>alert('Added')</script>";
				}
				else
				{
					echo"<script>alert('Failed')</script>";

				}
			
			}
			
			
		}
?>
<div class="hero-area hero-style-one">
         <div class="hero-background-layer"></div>
         <div class="container">
		 <?php
				$sql="select * from home_sec_1";
				$run=mysqli_query($con,$sql);
				$fetch=mysqli_fetch_assoc($run);
		 
		 ?>
            <div class="hero-content-wrap">
               <h2><?php echo $fetch['title'];?></h2>
               <p><?php echo $fetch['descr'];?></p>
               <form method="post" action="search_product.php"  name="myform" >
                  <div class="hero-search-form search-form-style-one">
                     <input  required type="text" name="search_text" placeholder="Search Your Products..." class="search-field">
                     <button type="submit"  class="search-submit" onsubmit="return validateform()">SEARCH</button>
					 <span class="text-danger" id="msg"></span>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="category-area-start category-style-one mt-100 position-relative">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-head-style-one">
				  <?php
					$sql="select * from home_sec_2";
					$run=mysqli_query($con,$sql);
					$fetch=mysqli_fetch_assoc($run);
				  ?>
                     <h2><?php echo $fetch['title'];?></h2>
                     <p><?php echo $fetch['descr'];?></p>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="category-slick">
				  <?php
					$sql="select * from menu_categories limit 5";
					$run=mysqli_query($con,$sql);
					while($fetch=mysqli_fetch_assoc($run))
					{
						?>
						<div class="category-box-alpha">
                        <div class="category-icon">
                           <a href="new_cat.php?id=<?php echo $fetch['id'];?>">
                              <img  width="60" height="56" viewBox="0 0 60 56" fill="none" src="images/<?php echo $fetch['image'];?>"></img>
                           </a>
                        </div>
                        <h5 class="category-title"><a href="new_cat.php?id=<?php echo $fetch['id'];?>"><?php echo $fetch['categary_name'];?></a></h5>
                     </div>
						<?php
					}
				  
				  ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="product-area product-grid-style-one pt-100">
         <div class="container position-relative">
            <span class="gradien-bg1"></span>
            <span class="gradien-bg2"></span>
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-head-style-one">
				  <?php
					$sql="select * from menu_title";
					$run=mysqli_query($con,$sql);
					$fetch=mysqli_fetch_assoc($run);
				  
				  
				  ?>
                     <h2><?php echo $fetch['title'];?></h2>
                     <p><?php echo $fetch['descr'];?></p>
                  </div>
               </div>
               <div class="col-12">
                  <div class="product-grid-top d-flex align-content-center justify-content-end">
                     <a href="product.php" class="eg-btn btn--capsule white-btn-title-color">View All</a>
                  </div>
               </div>
               <div class="col-12">
                  <div class="best-deal-slider">
				  <?php
				  $sql="select * from menu_items";
					$qr=mysqli_query($con,$sql);
					while($fetch=mysqli_fetch_assoc($qr))
					{
						?>
                     <div class="eg-product-carde-alpha">
                       
                        <div class="eg-porduct-thumb">
                           <a href="shop_details.php?id=<?php echo $fetch['id'];?>">
                           <img src="images/<?php echo $fetch['image'];?>" alt="">
                           </a>
                           <div class="thumb-action">
						<?php
							if(!isset($_SESSION['u_name']))
							{
								?>
								<a href="login.php"><i class="bi bi-heart"></i></a>
								<?php

							}
							else
							{
								$p_id=$fetch['id'];
								$u_id=$_SESSION['id'];
								$fav_sql="select * from favraite where user_id='$u_id' and product_id='$p_id'";
								$fav_run=mysqli_query($con,$fav_sql);
								$count=mysqli_num_rows($fav_run);
								if($count > 0)
								{
									?>
								
									<form action="" method="post">
			<input type="hidden" name="product_id" id="" value="<?php echo $fetch['id'];?>"/>
			<button type="submit" name="insert" class="lar la-heart" style="background-color:green;color:white;">
								</form>
									<?php
								}
								else
								{
									
								
								?>
								
								
								<form action="" method="post">
								<input type="hidden" name="product_id" id="" value="<?php echo $fetch['id'];?>"/>
						<button type="submit"  name="insert" class="bi bi-heart" style="background-color:orange;color:white;">
								</form>
								<?php
								}
							}
						
						?>
								
                           </div>
                        </div>
                        <div class="eg-porduct-body">
                           <h5 class="eg-product-title"><a href="product-details.html"><?php echo $fetch['food_name'];?></a></h5>
                           <div class="eg-product-card-price">
                              <del><span class="price-discounted-amount"><bdi><span class="price-meater"></span></bdi></span></del>
                              <ins><span class="price-amount"><bdi><?php echo $fetch['price'];?></bdi><span class="price-meater"></span></span></ins>
                           </div>
                           <div class="product-card-bottom">
                              <ul class="product-rating">
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                              </ul>
                              <div class="product-add-btn">
	<input type="hidden" name="hidden_name" id="name<?php echo $fetch['id'];?>" value="<?php echo  $fetch['food_name'];?>" />
    <input type="hidden" name="hidden_price" id="price<?php echo $fetch['id'];?>" value="<?php echo  $fetch['price'];?>" />
    <a href="" name="add_to_cart" class="view form-control add_to_cart"  id="<?php echo $fetch['id'];?>">Add to cart<i class="bi bi-plus-lg"></i></a> </button>
							
								</button>
                              </div>
                           </div>
                        </div>
                     </div>
						
					<?php		
					}
				  ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="banner-area banner-group-one pt-80">
         <div class="container-fluid">
            <div class="row g-4">
			<?php
			$sql="select * from offers limit 3";
					$run=mysqli_query($con,$sql);
					while($fetch=mysqli_fetch_assoc($run))
					{
			
			?>
			
               <div class="col-lg-4">
                  <div class="banner-style-alpha style-one justify-content-end " style="background: url(images/<?php echo $fetch['image'];?>) no-repeat center;">
                     <div class="banner-content text-end">
                        <h6><?php echo $fetch['discount'];?>% off</h6>
						<?php
						$cat_id=$fetch['cat_id'];
							$sel="select * from menu_categories where id='$cat_id'";
							$qry=mysqli_query($con,$sel);
							while($res=mysqli_fetch_assoc($qry))
							{
						
						
						?>
							<h3><?php echo $res['categary_name'];}?></h3>
                        <div class="banner-btn">
                           <a href="offer_cat.php?cat_id=<?php echo $fetch['cat_id'];?>" class="eg-btn btn--capsule white-btn">Shop Now</a>
                        </div>
                     </div>
                  </div>
               </div>
			   <?php
					}
			   ?>
              
            </div>
         </div>
      </div>
      <div class="product-area product-grid-style-one pt-100">
         <div class="container position-relative">
            <span class="gradien-bg3"></span>
            <span class="gradien-bg2"></span>
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-head-style-one">
                     <h2>Our Special Product</h2>
                     <p>A virtual assistant collects the product from your list</p>
                  </div>
               </div>
               <div class="col-12">
                  <div class="product-grid-top d-flex align-content-center justify-content-end">
                     <a href="product.php" class="eg-btn btn--capsule white-btn-title-color">View All</a>
                  </div>
               </div>
               <div class="col-12">
                  <div class="special-prod-slider">
                    <?php
				  $sql="select * from menu_items where featured='1'";
					$qr=mysqli_query($con,$sql);
					while($fetch=mysqli_fetch_assoc($qr))
					{
						?>
                     <div class="eg-product-carde-alpha">
                        
                        <div class="eg-porduct-thumb">
                           <a href="shop_details.php?id=<?php echo $fetch['id'];?>">
                           <img src="images/<?php echo $fetch['image'];?>" alt="">
                           </a>
                           <div class="thumb-action">
                              <?php
							if(!isset($_SESSION['u_name']))
							{
								?>
								<a href="login.php"><i class="bi bi-heart"></i></a>
								<?php

							}
							else
							{
								$p_id=$fetch['id'];
								$u_id=$_SESSION['id'];
								$fav_sql="select * from favraite where user_id='$u_id' and product_id='$p_id'";
								$fav_run=mysqli_query($con,$fav_sql);
								$count=mysqli_num_rows($fav_run);
								if($count > 0)
								{
									?>
								
									<form action="" method="post">
			<input type="hidden" name="product_id" id="" value="<?php echo $fetch['id'];?>"/>
			<button type="submit" name="insert" class="lar la-heart" style="background-color:green;color:white;">
								</form>
									<?php
								}
								else
								{
									
								
								?>
								
								
								<form action="" method="post">
								<input type="hidden" name="product_id" id="" value="<?php echo $fetch['id'];?>"/>
						<button type="submit"  name="insert" class="bi bi-heart" style="background-color:orange;color:white;">
								</form>
								<?php
								}
							}
						
						?>
								
                           </div>
                        </div>
                        <div class="eg-porduct-body">
                           <h5 class="eg-product-title"><a href="product-details.html"><?php echo $fetch['food_name'];?></a></h5>
                           <div class="eg-product-card-price">
                              <ins><span class="price-amount"><bdi><?php echo $fetch['price'];?></bdi><span class="price-meater"></span></span></ins>
                           </div>
                           <div class="product-card-bottom">
                              <ul class="product-rating">
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                                 <li><i class="bi bi-star-fill"></i></li>
                              </ul>
                              <div class="product-add-btn">
	<input type="hidden" name="hidden_name" id="name<?php echo $fetch['id'];?>" value="<?php echo  $fetch['food_name'];?>" />
    <input type="hidden" name="hidden_price" id="price<?php echo $fetch['id'];?>" value="<?php echo  $fetch['price'];?>" />
    <a href="" name="add_to_cart" class="view form-control add_to_cart"  id="<?php echo $fetch['id'];?>">Add to cart<i class="bi bi-plus-lg"></i></a> </button>
							
								</button>
                              </div>
                           </div>
                        </div>
                     </div>
						
					<?php		
					}
				  ?>
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="blog-area-start blog-style-one pt-80">
         <div class="container">
            <div class="row g-4">
               <div class="col-lg-12">
                  <div class="section-head-style-one">
				  <?php
					$sql="select * from home_blog";
					$run=mysqli_query($con,$sql);
					$fetch=mysqli_fetch_assoc($run);
				  ?>
                     <h2><?php echo $fetch['title'];?></h2>
                     <p><?php echo $fetch['descr'];?></p>
                  </div> 
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="blog-card highlighted-blog-style">
                     <div class="blog-thumb">
					 <?php
				$sql="select * from blog_detail";
				$run=mysqli_query($con,$sql);
				$fetch=mysqli_fetch_assoc($run);
				
				?>
                        <a href="blog_detail.php?id=<?php echo $fetch['id'];?>"><img src="images/<?php echo $fetch['image'];?>" alt=""></a>
                     </div>
                     <div class="blog-body">
                        <h4 class="blog-title"><a href="blog_detail.php?id=<?php echo $fetch['id'];?>"><?php echo $fetch['title'];?></a>
                        </h4>
                        <p><?php echo $fetch['short_descr'];?></p>
                        <div class="blog-bottom">
                           <div class="blog-btn">
                              <a href="blog_detail.php?id=<?php echo $fetch['id'];?>">Read more</a>
                           </div>
                           <div class="blog-date">
                              <a href="#">Date: <?php echo $fetch['date'];?></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
			   <?php
				$sql="select * from blog_detail ORDER BY id DESC limit 3";
				$run=mysqli_query($con,$sql);
				while($fetch=mysqli_fetch_assoc($run))
				{
				?>
                  <div class="blog-card blog-card-alpha">
				  
                     <div class="row g-3 d-flex align-items-center">
                        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-4 col-sm-5">
                           <div class="blog-thumb">
                              <a href="blog_detail.php?id=<?php echo $fetch['id'];?>"><img src="images/<?php echo $fetch['image'];?>" class="img-fluid" alt=""></a>
                           </div>
                        </div>
                        <div class="col-xxl-8 col-xl-7 col-lg-6 col-md-8 col-sm-7">
                           <div class="blog-body">
                              <h5 class="blog-title"><a href="blog-details.html"><?php echo $fetch['title'];?>
                               </a>
                              </h5>
                              <p><?php echo $fetch['short_descr'];?></p>
                              <div class="blog-bottom">
                               <!--  <a href="#" class="blog-writer"><i class="bi bi-person"></i> Sara Watson </a>-->
                                 <span><a href="#" class="blog-date"><?php echo $fetch['date'];?></a></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  <?php
				}
				  ?>
                
               </div>
            </div>
         </div>
      </div>
      <div class="feature-area feature-style-one  mb-100 pt-76">
         <div class="container">
            <div class="row">
              <?php
		$sql="select * from about_gr_4";
		$run=mysqli_query($con,$sql);
		while($fetch=mysqli_fetch_assoc($run))
		{
	
	
	?>
	<div class="col-lg-3 col-md-6 col-sm-6">
	<div class="feature-card-alpha">
	<div class="feature-icon">
	<img src="images/<?php echo $fetch['image'];?>" alt="">
	</div>
	<div class="feature-content">
	<h5><?php echo $fetch['title'];?></h5>
	<p><?php echo $fetch['sub_title'];?></p>
	</div>
	</div>
	</div>
	<?php
		}
	?>
              
            </div>
         </div>
      </div>
	  


<?php

	include 'footer.php';
	
?>
<script>
	function validateform(){  
		var search_text=document.myform.search_text.value;  
		
		if (search_text==null || search_text==""){  
			 alert("Name can't be blank"); 
						document.getElementById("msg").innerHTML="please enter any product";

			  return false;  
			}  
			else
			{
					document.getElementById("msg").innerHTML="";

			}
		
		
</script>