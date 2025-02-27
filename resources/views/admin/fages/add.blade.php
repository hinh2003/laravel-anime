@include('admin.index')
@include('admin.header')

<section class="ftco-section">
    <div class="container">
        <form id="themphim" method="POST" action="{{ route('movies.add.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 style="color: white;" class="heading-section">Phim</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Tên Phim</td>
                                <th><input type="text" name="name_movie" id="name_movie" required></th>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <th><input type="text" name="slug_movie" id="slug_movie" required readonly></th>
                            </tr>
                            <tr>
                                <td>Số Tập</td>
                                <th><input type="number" name="episodes" id="episodes" required></th>
                            </tr>
                            <tr>
                                <td>Ảnh</td>
                                <th><input type="file" id="pic" name="pic" required></th>
                            </tr>
                            <tr>
                                <td>Nước</td>
                                <th>
                                    <select id="country_id" name="country_id" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name_country }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <td>Trạng thái</td>
                                <th>
                                    <select id="status_id" name="status_id" required>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name_satus }}</option>
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
                                    <div   id="selected_categories"  ></div>
                                    <input type="hidden" id="name_category" name="name_category[]" required>

                                </td>
                                </th>
                            </tr>
                            <tr>
                                <td>Miêu tả</td>
                                <th><input type="text" id="description" name="description" required></th>
                            </tr>
                            </tbody>
                        </table>
                        <p style="color: red;" id="result1"></p>
                        <input type="submit" id="themphim" name="themphim" value="Thêm Phim">
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

        var isSelected = document.querySelector('#tag_' + selectedOption);
        if (!isSelected) {
            var tag = document.createElement('span');
            tag.classList.add('category-tag');
            tag.id = 'tag_' + selectedOption;
            tag.innerHTML = selectedText + '<span class="remove-tag" onclick="removeTag(' + selectedOption + ')">&times;</span>';

            var selectedCategories = document.querySelector('#selected_categories');
            selectedCategories.appendChild(tag);

            updateHiddenInput();
        }
    });

    function removeTag(categoryId) {
        var tagToRemove = document.querySelector('#tag_' + categoryId);
        if (tagToRemove) {
            tagToRemove.remove();
            updateHiddenInput();
        }
    }

    function updateHiddenInput() {
        var selectedTags = document.querySelectorAll('.category-tag');
        var categoryIds = [];

        selectedTags.forEach(function (tag) {
            var tagId = tag.id.replace('tag_', '');
            categoryIds.push(tagId);
        });

        document.querySelector('#name_category').value = categoryIds.join(',');
    }
</script>

