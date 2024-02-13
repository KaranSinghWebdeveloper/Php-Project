const container = document.getElementById('isotope-grid');
const load = document.getElementById('loaddata');
const orderby = document.getElementById('orderby');

order = 'ASC';

orderby.addEventListener('click', function () {
	order = order === 'ASC' ? 'DESC' : 'ASC';
	withorder = `protected/allpost.php?orderby=${order}`;
	getData();
});


post = `protected/allpost.php?orderby=${order}`;
getData();

load.addEventListener('click', function () {
	const load = 4;
	post = `protected/allpost.php?load=${load}`;
	const datanew = getData();
});

function getData() {
	fetch(post)
		.then(res => res.json())
		.then(data => {
			data.forEach(totaldata => {
				//console.log(totaldata);
				const img = totaldata.image;
				let separatedArray = img.split(', ');
				let per = ((totaldata.price - totaldata.lessprice) / totaldata.price) * 100;
				let newper = Math.round(per);
				//console.log(separatedArray);
				container.innerHTML += `<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ${totaldata.category}">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="images/${separatedArray[0]}" alt="">

							<a href="" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Quick View
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									${totaldata.title}
								</a>

								<span class="stext-105 cl3" style="text-decoration-line: line-through; ">
									Rs. ${totaldata.price}
								</span>
								<span class="stext-105 cl3">
									Rs. ${totaldata.lessprice}
								</span>
								<span class="stext-105 cl3 badge bg-danger	 text-white">
									${newper} %
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="" class="">
									<span class="stext-105 cl3 badge bg-success text-white shadow">
									${totaldata.category}
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>`;

			})
		})
		.catch(error => console.error('Error:', error));
}

//console.log(datanew);

























