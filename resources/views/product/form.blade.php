@extends('layout.main')
@section('main-section')
    <div class="container mt-5">
        <h2>Advanced Form</h2>
        <form action="{{ isset($show) ? '/admin/product/update/' . $show->id : '/admin/product/store' }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table id="table" class="table">
                <tbody>
                <tr>
                    <td>
                        <label class="form-label h5">Title</label>
                        <input type="text" name="title[0][title]" placeholder="Enter your Title" class="form-control" />
                        @error('title.0.title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>

                    <td>
                        <label class="form-label h5">Price</label>
                        <input type="text" name="price[0][price]" placeholder="Enter your Price" class="form-control" />
                        @error('price.0.price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>

                    <td>
                        <label class="form-label h5">Image</label>
                        <input type="file" class="form-control" name="img[0][img]" placeholder="Enter your Img">
                        @error('img.0.img')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>

                    <td>
                        <div class="mb-3">
                            <label class="form-label h5">Brand</label>
                            <select class="form-control" name="brand_id[0][brand_id]">
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                @endforeach
                            </select>
                            @error('brand_id.0.brand_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>

                    <td>
                        <div class="mb-3">
                            <label class="form-label h5">Category</label>
                            <select class="form-control" name="category_id[0][category_id]">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id.0.category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </td>

                    <td>
                        <button type="button" id="add" class="btn btn-success">Add Row</button>
                    </td>
                </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var i = 0;
        $('#add').click(function () {
            ++i;
            $('#table tbody').append(`
            <tr>
                <td><input type="text" name="title[` + i + `][title]" placeholder="Enter your Title" class="form-control title-field"/></td>
                <td><input type="text" name="price[` + i + `][price]" placeholder="Enter your Price" class="form-control price-field"/></td>
                <td><input type="file" name="img[` + i + `][img]" class="form-control img-field"/></td>
                <td>
                    <select class="form-control" name="brand_id[` + i + `][brand_id]">
                        @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                        @endforeach
            </select>
        </td>
        <td>
            <select class="form-control" name="category_id[` + i + `][category_id]">
                        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
            </select>
        </td>
        <td><button type="button" class="btn btn-danger remove">Remove</button></td>
    </tr>
`);
        });

        // Remove row
        $(document).on('click', '.remove', function () {
            $(this).closest('tr').remove();
        });

        // Form submission validation
        $('form').on('submit', function(e) {
            var isValid = true;

            // Validate title fields
            $('.title-field').each(function() {
                if ($(this).val().trim() === '') {
                    alert('Title field cannot be empty!');
                    isValid = false;
                    return false; // Exit the loop if invalid
                }
            });

            // Validate price fields
            $('.price-field').each(function() {
                if ($(this).val().trim() === '' || isNaN($(this).val())) {
                    alert('Price must be a valid number!');
                    isValid = false;
                    return false;
                }
            });

            // Validate image fields
            $('.img-field').each(function() {
                if ($(this).val() === '') {
                    alert('Please upload an image!');
                    isValid = false;
                    return false;
                }
            });

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if invalid
            }
        });
    </script>


@endsection
