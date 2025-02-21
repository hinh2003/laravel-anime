@include('admin.index')
@include('admin.header')

<section class="ftco-section">
    <div class="container">
        <form id="capnhatphim" method="POST" action="{{ route('movies.update', $movie->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 style="color: white;" class="heading-section">Cập nhật Phim</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tên Phim</td>
                                <th><input type="text" name="name_movie" id="name_movie" value="{{ $movie->name_movie }}" required></th>
                            </tr>
                            <tr>
                                <td>Số Tập</td>
                                <th><input type="number" name="years" id="years" value="{{ $movie->years }}" required></th>
                            </tr>
                            <tr>
                                <td>Ảnh</td>
                                <th><input type="file" id="pic" name="pic"></th>
                            </tr>
                            <tr>
                                <td>Nước</td>
                                <th>
                                    <select id="country_id" name="country_id" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $movie->country_id == $country->id ? 'selected' : '' }}>{{ $country->name_country }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <td>Trạng thái</td>
                                <th>
                                    <select id="status_id" name="status_id" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $movie->status_id == $status->id ? 'selected' : '' }}>{{ $status->name_satus }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <td>Thể Loại</td>
                                <td>
                                    <select id="category_id" name="category_id"  required >
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="name_category[]" id="name_category" value="{{ implode(',', $movie->categories->pluck('id')->toArray()) }}" required>
                                    <div id="selected_categories">
                                        @foreach ($movie->categories as $category)
                                            <div id="selected_categories_{{ $category->id }}" class="category-tag">
                                                {{ $category->name_category }}
                                                <span class="remove-tag" onclick="removeTag({{ $category->id }})">&times;</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                </th>
                            </tr>
                            <tr>
                                <td>Miêu tả</td>
                                <th><input type="text" id="description" name="description" value="{{ $movie->description }}" required></th>
                            </tr>
                            </tbody>
                        </table>
                        <p style="color: red;" id="result1"></p>
                        <input type="submit" id="capnhatphim" name="capnhatphim" value="Cập nhật Phim">
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br>
        @include('Error.login')
    </div>
</section>
<script>
    document.querySelector('#category_id').addEventListener('change', function () {
        var selectedOption = this.value;
        var selectedText = this.options[this.selectedIndex].text;

        // Check if the selected option is already selected
        var isSelected = document.querySelector('#selected_categories_' + selectedOption);
        if (!isSelected) {
            // Create a new tag element
            var tag = document.createElement('div');
            tag.classList.add('category-tag');
            tag.id = 'selected_categories_' + selectedOption;
            tag.innerHTML = selectedText + ' <span class="remove-tag" onclick="removeTag(' + selectedOption + ')">&times;</span>';

            // Append the tag to the selected_categories div
            var selectedCategories = document.querySelector('#selected_categories');
            selectedCategories.appendChild(tag);

            // Update the hidden input value
            updateHiddenInput();
        }
    });

    function removeTag(categoryId) {
        // Xóa thẻ tag trong selected_categories
        var tagToRemove = document.querySelector('#selected_categories_' + categoryId);
        if (tagToRemove) {
            tagToRemove.remove();
        }

        // Cập nhật hidden input
        updateHiddenInput();
    }

    function updateHiddenInput() {
        var selectedTags = document.querySelectorAll('.category-tag');
        var categoryIds = [];

        selectedTags.forEach(function (tag) {
            var tagId = tag.id.replace('selected_categories_', '');
            categoryIds.push(tagId);
        });

        document.querySelector('#name_category').value = categoryIds.join(',');
    }

</script>
