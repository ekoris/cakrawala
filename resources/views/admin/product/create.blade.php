@extends('layouts.master')

@push('breadcumb')
<h4 class="page-title pull-left">Admin</h4>
<ul class="breadcrumbs pull-left">
    <li><a href="">Home</a></li>
    <li><span>Produk</span></li>
</ul>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-8 mt-5">
        <div class="card">
            <div class="card-body">
                <form role="form" method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="name" required class="form-control" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category_id" class="form-control" id="">
                                @foreach (resolve(App\Models\Category::class)->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image Thumbnail</label>
                            <div class="input-group input-group-outline mb-3">
                                <input type='file' clas name="image" onchange="readURL(this);"/>
                                <br>
                                <img id="blah" style="height: 200px;" src="{{ asset('assets/images/blog/post-thumb1.jpg') }}" alt="your image" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="upload__box" style="box-sizing: border-box;">
                                <div class="upload__btn-box">
                                    <label class="upload__btn">
                                        <p>Gambar Lain</p>
                                        <input type="file" multiple="" data-max_length="20" name="file[]" class="upload__inputfile">
                                    </label>
                                </div>
                                <div class="upload__img-wrap">
                                    <div class="upload__img-box">
                                        <div style="width:100%;">
                                            <div class="row img-preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deskripsi</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" class="form-control" name="price" value="" placeholder="Price">
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: right">
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- table dark end -->
</div>
@endsection

@push('style')
<style>

	.upload {
		&__box {
			padding: 40px;
		}
		&__inputfile {
			width: .1px;
			height: .1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}
		
		&__btn {
			display: inline-block;
			font-weight: 600;
			color: #fff;
			text-align: center;
			min-width: 116px;
			padding: 5px;
			transition: all .3s ease;
			cursor: pointer;
			border: 2px solid;
			background-color: #4045ba;
			border-color: #4045ba;
			border-radius: 10px;
			line-height: 26px;
			font-size: 14px;
			
			&:hover {
				background-color: unset;
				color: #4045ba;
				transition: all .3s ease;
			}
			
			&-box {
				margin-bottom: 10px;
			}
		}
		
		&__img {
			&-wrap {
				display: flex;
				flex-wrap: wrap;
				margin: 0 -10px;
			}
			
			&-box {
				width: 200px;
				padding: 0 10px;
				margin-bottom: 12px;
			}
			
			&-close {
				width: 24px;
				height: 24px;
				border-radius: 50%;
				background-color: rgba(0, 0, 0, 0.5);
				position: absolute;
				top: 10px;
				right: 10px;
				text-align: center;
				line-height: 24px;
				z-index: 1;
				cursor: pointer;
				
				&:after {
					content: '\2716';
					font-size: 14px;
					color: white;
				}
			}
		}
	}
	
	.img-bg {
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		position: relative;
		padding-bottom: 100%;
	}
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="{{ asset('assets/admin') }}/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
	jQuery(document).ready(function () {
		ImgUpload();
	});

	$(document).on('click', '.upload-edition .repeat-add', function(e){
		e.preventDefault();
		let template = `
		<div class="d-flex pb-8 repeat-row">
			<div class="form-file__input w-100">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" name="product_edition[]" placeholder="Add Edition">
						</div>
					</div>
					<div class="col-md-2">
						<a href="" class="repeat-add ml-8 my-auto">
							<button class="btn btn-warning btn-sm">Add Edition</button>
						</a>
					</div>
				</div>
			</div>
		</div>`;
		
		$(this).closest('.repeat-container').append(template);
		$(this).html('<button class="btn btn-danger btn-sm">remove</button><br>').attr('class', 'repeat-remove ml-8 my-auto')
	});

	$(document).on('click', '.repeat-remove', function(e){
		e.preventDefault()
		$(this).closest('.repeat-row').remove()
	});
	
	function ImgUpload() {
		var imgWrap = "";
		var imgArray = [];
		
		$('.upload__inputfile').each(function () {
			$(this).on('change', function (e) {
				imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap').find('.upload__img-box').find('.img-preview');
				var maxLength = $(this).attr('data-max_length');
				
				var files = e.target.files;
				var filesArr = Array.prototype.slice.call(files);
				var iterator = 0;
				
				
				filesArr.forEach(function (f, index) {
					
					if (!f.type.match('image.*')) {
						return;
					}
					
					if (imgArray.length > maxLength) {
						return false
					} else {
						var len = 0;
						for (var i = 0; i < imgArray.length; i++) {
							if (imgArray[i] !== undefined) {
								len++;
							}
						}
						if (len > maxLength) {
							return false;
						} else {
							imgArray.push(f);
							
							var reader = new FileReader();
							reader.onload = function (e) {
								var html = "<div class='col-md-2'><input type='hidden' name='images[]' value='" + e.target.result + "' ><img width='100%' src='" + e.target.result + "' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "'/><div class='upload__img-close' style='margin-top:30px'><button class='btn btn-danger btn-sm btn-block'>Remove</button></div></div>";
								imgWrap.append(html);
								iterator++;
							}
							reader.readAsDataURL(f);
						}
					}
				});
			});
		});
		
		$('body').on('click', ".upload__img-close", function (e) {
			var file = $(this).parent().data("file");
			for (var i = 0; i < imgArray.length; i++) {
				if (imgArray[i].name === file) {
					imgArray.splice(i, 1);
					break;
				}
			}
			$(this).parent().remove();
		});
	}
	
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah').show();
				$('#blah').attr('src', e.target.result);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
@endpush