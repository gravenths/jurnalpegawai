<div class="container">
	<div class="jumbotron text-center">
		<h3>Kami ada untuk Anda</h3>
	</div>
	<div style="margin:40px 0">
		<div class="row">
			<div class="col-sm-5">
				<div class="panel-body panel">
					<?php $this::display_page_errors(); ?>
					<h4>Berbagi info melalui Email</h4>
					<hr />
					<form method="post" action="<?php print_link("info/contact"); ?>">
						<div class="form-group">
							<input type="text" class="form-control" required id="name" name="name" placeholder="Enter Your name *">
						</div>

						<div class="form-group">
							<input type="email" class="form-control" required id="email" name="email" placeholder="Enter Your email *">
						</div>

						<div class="form-group">
							<textarea class="form-control" id="msg" name="msg" rows="4" required placeholder="Enter your Message *"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
			</div>

			<div class="col-sm-7">
				<div class="panel panel-body">
					<h4>Cara lain menghubungi kami:</h4>
					<hr />

					<p>
						<b class="chead"><span class="material-icons">SMA Negeri 8 Banjarmasin</span> | Location</b><br />
						<p class="adr clearfix">
							<span class="adr-group">
								<span class="street-address">Jl. SMAN 8 RT 23 RW 02 No. 26 Banjarmasin</span><br>
								<span class="postal-code">Kode Pos 70126</span><br>
								<span class="country-name">Banjarmasin, Kalimantan Selatan</span>
							</span>
						</p>
					</p>
					<hr />
					<p>
						<b class="chead"><span class="material-icons">contact_person</span> via telephone</b><br />
						<span class="editContent"> +5113300336 </span>
					</p>
					<hr />

					<p>
						<b class="chead"><span class="material-icons"></span> e-mail</b><br />
						<a href="#" class="editContent">smanegeri8banjarmasin@gmail.com</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>