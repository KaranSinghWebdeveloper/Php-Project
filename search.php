<?php include "header.php";?>

	<!-- Product -->
	<div class="bg0 p-b-140">
		<div class="container">
				<h1 style="margin-top:90px;margin-bottom:70px; " class="text-center"><span class="bg-success p-2 rounded text-white"><?php if(isset($_GET['search'])){
                    echo $search = $_GET['search']; }else{ echo "";}?></span> Search Product</h1>
			

			<div class="row isotope-grid">
                
				<?php 
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM post
                        LEFT JOIN category ON post.category_id = category.category_id
                        LEFT JOIN color ON post.color_id = color.color_id
                        LEFT JOIN brand ON post.brand_id = brand.brand_id
                        LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id 
                        WHERE post.title LIKE '%$search%' 
                        OR post.peragraph LIKE '%$search%'
                        OR color.color LIKE '%$search%'
                        OR brand.brand LIKE '%$search%'
                        OR category.category LIKE '%$search%'
                        OR subcategory.subcategory LIKE '%$search%'
                        ";
                    $row = selectWithSql($sql);
                }else{        
				$sql = "SELECT * FROM post
				LEFT JOIN category ON post.category_id = category.category_id
				LEFT JOIN color ON post.color_id = color.color_id
				LEFT JOIN brand ON post.brand_id = brand.brand_id
				LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id WHERE post.status = '1' ORDER BY post.id DESC";
                $row = selectWithSql($sql);
				}
				if(!empty($row)){
                    foreach($row as $row){
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo strtolower($row['category']);?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<?php $image = explode(', ', $row['image']);
									foreach($image as $image){}
							?>
							<img src="images/<?php echo $image; ?>" alt="<?php echo $row['title']?>">

							<a href="<?php echo $productpage; ?>?post=<?php echo $row['id'];?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $row['title']?>
								</a>

								<span class="stext-105 cl3" style="text-decoration-line: line-through; ">
									Rs. <?php echo $row['price']?>
								</span>
								<span class="stext-105 cl3">
									Rs. <?php echo $row['lessprice']?>
								</span>
								<span class="stext-105 cl3 badge bg-danger	 text-white">
									<?php 
									$off = ($row['lessprice'] / $row['price']) * 100;
									$num = round($off);
									$per = 100 - $num;
									echo $per.'% Off';
									?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="<?php echo $categorypage.'?category='.$row['category_id']?>" class="">
									<span class="stext-105 cl3 badge bg-success text-white shadow">
									<?php echo $row['category']?>
									</span>
								</a>
							</div>
							
						</div>
					</div>
				</div>
				<?php }  } ?>
                <?php
				$sql = "SELECT * FROM post
				LEFT JOIN category ON post.category_id = category.category_id
				LEFT JOIN color ON post.color_id = color.color_id
				LEFT JOIN brand ON post.brand_id = brand.brand_id
				LEFT JOIN subcategory ON post.subcategory_id = subcategory.subcategory_id WHERE post.status = '1' ORDER BY post.id DESC";
                $row = selectWithSql($sql);
				if(!empty($row)){
                    foreach($row as $row){
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo strtolower($row['category']);?>">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<?php $image = explode(', ', $row['image']);
									foreach($image as $image){}
							?>
							<img src="images/<?php echo $image; ?>" alt="<?php echo $row['title']?>">

							<a href="<?php echo $productpage; ?>?post=<?php echo $row['id'];?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $row['title']?>
								</a>

								<span class="stext-105 cl3" style="text-decoration-line: line-through; ">
									Rs. <?php echo $row['price']?>
								</span>
								<span class="stext-105 cl3">
									Rs. <?php echo $row['lessprice']?>
								</span>
								<span class="stext-105 cl3 badge bg-danger	 text-white">
									<?php 
									$off = ($row['lessprice'] / $row['price']) * 100;
									$num = round($off);
									$per = 100 - $num;
									echo $per.'% Off';
									?>
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="<?php echo $categorypage.'?category='.$row['category_id']?>" class="">
									<span class="stext-105 cl3 badge bg-success text-white shadow">
									<?php echo $row['category']?>
									</span>
								</a>
							</div>
							
						</div>
					</div>
				</div>
				<?php }  } ?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="images/product-16.jpg" alt="IMG-PRODUCT">

							<a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									Square Neck Back
								</a>

								<span class="stext-105 cl3">
									$29.64
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Load more -->
			
		</div>
	</div>
		

<?php
	include "footer.php";
?>  