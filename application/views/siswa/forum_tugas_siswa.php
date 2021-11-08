<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <?php
                if ($this->session->userdata('role') == 1) {
                ?>

                    <h1>
                        JAWAB SISWA
                    </h1>
                <?php
                } elseif ($this->session->userdata('role') == 2) {
                ?>
                    <h1>
                        TANYA GURU
                    </h1>
                <?php
                } ?>
            </div>

            <div class="body">
                <?php
                foreach ($forum[0] as $row) {
                    if ($this->session->userdata('username') == $row->username) {
                ?>
                        <div class="row clearfix">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-10 bg-primary">
                                <div class="card hover-expand-effect text-left">
                                    <div class="header">
                                        <div class="pull-right"><?= $row->tgl_forum ?></div>

                                        <h4>Anda</h4>

                                    </div>
                                    <div class="body">
                                        <!-- cols="87" -->
                                        <?php echo $row->isi;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row clearfix">
                            <div class="col-lg-10 bg-red">
                                <div class="card hover-expand-effect">
                                    <div class="header">
                                        <div class="pull-right"><?= $row->tgl_forum ?></div>
                                        <h4><?= $row->nama ?></h4>
                                    </div>
                                    <div class="body">
                                        <textarea name="" id="" rows="5" style="width: 100%; resize: none; overflow-y: auto; border: 0px; outline: none;" readonly><?= $row->isi ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="card">
                    <form method="POST" action="<?= base_url('siswa/addForum/'.$forum[1]) ?>" enctype="multipart/form-data">
                
                        <div class="col-md-12" id="text-forum-chat">
                            <input type="hidden" name="isi" >
                            <div id="editor" style="min-height: 160px;"></div>   
                        </div>
                <div class="row">
                    <div class="col-md-10 input">
                        <div class="custom-file">
                            <input type="file" name="berkas" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, docx, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                            <!-- <label class="custom-file-label" for="exampleInputFile">Pilih File</label> -->
                            
                        </div> 
                    </div>
                    <div class="col-lg-1" id="kirim-forum">
                            <input type="hidden" name="tambah">
                            <button class="btn btn-block bg-green" type="submit">Kirim
                                <i class="material-icons">

                                </i>
                            </button>
                    </div>
                </div>    
                    </form>
                    
                </div>
            </div>
            <div class="footer">
              
            </div>
        </div>
        
    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
			<script>
				var quill = new Quill('#editor', {
					theme: 'snow',
					modules: {
						toolbar: [
								[{ header: [1, 2, 3, 4, 5, 6, false] }],
								[{ font: [] }],
								["bold", "italic"],
								["link", "blockquote", "code-block", "image"],
								[{ list: "ordered" }, { list: "bullet" }],
								[{ script: "sub" }, { script: "super" }],
								[{ color: [] }, { background: [] }],
						]
				},
				});
				quill.on('text-change', function(delta, oldDelta, source) {
					document.querySelector("input[name='isi']").value = quill.root.innerHTML;
				});
			</script>
    <!-- #END# Basic Examples -->
</div>