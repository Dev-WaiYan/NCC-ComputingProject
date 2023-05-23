<?php
$__cssLinks = ['styles/pages/admin/product.css'];

$data = ProductController::getData();

?>

<style>
    #rich-text-editor-container {
        min-height: 400px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }

    .ck-tooltip {
        background-color: var(--bgColor) !important;
    }
</style>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 d-flex justify-content-center my-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Cover Img</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->products as $value) {
                    if (is_array($value)) { ?>
                        <tr>
                            <th scope="row"><?php echo $value['id'] ?></th>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo "<img src=" . STORAGE_BASE_URL . "/" . $value['cover_img'] . " class='img-fluid' />" ?></td>
                            <td><?php echo $value['price'] ?></td>
                            <td>
                                <strong>
                                    <?php echo
                                    $data->categories[array_search($value['product_category_id'], array_column($data->categories, 'id'))]['category_name']
                                    ?>
                                </strong>
                            </td>
                            <td><?php echo $value['created_at'] ?></td>
                            <td><?php echo $value['updated_at'] ?></td>
                            <td><button class="btn btn-primary mb-2 me-3" data-bs-toggle="modal" data-bs-target="#editModal" onclick="defineEditedItem(<?php echo $value['id']; ?>)">Edit</button><button class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="defineDeletedItem(<?php echo $value['id']; ?>)">Delete</button></td>
                        </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
        <!-- <nav aria-label="products">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
            </ul>
        </nav> -->
    </div>
    <!-- form utils -->
    <input type="hidden" id="editedItemId" />
    <input type="hidden" id="deletedItemId" />
</main>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="n_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="n_name">
                    </div>
                    <div class="mb-3">
                        <label for="n_shortDescription" class="form-label">Short Description</label>
                        <input type="text" class="form-control" id="n_shortDescription">
                    </div>
                    <div class="mb-3">
                        <label for="n_description" class="form-label">Description</label>
                        <textarea name="n_description" id="n_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="n_coverImg" class="form-label">Cover Img</label>
                        <input type="file" class="form-control" id="n_coverImg">
                    </div>
                    <div class="mb-3">
                        <label for="n_price" class="form-label">Price - USD</label>
                        <input type="text" class="form-control" id="n_price">
                    </div>
                    <div class="mb-3">
                        <label for="n_category" class="form-label">Category</label>
                        <select class="form-control" id="n_category">
                            <?php
                            foreach ($data->categories as $value) { ?>
                                <option value=<?php echo $value['id'] ?>><?php echo $value['category_name'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="add()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="e_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="e_name">
                    </div>
                    <div class="mb-3">
                        <label for="e_shortDescription" class="form-label">Short Description</label>
                        <input type="text" class="form-control" id="e_shortDescription">
                    </div>
                    <div class="mb-3">
                        <label for="e_description" class="form-label">Description</label>
                        <textarea name="e_Description" id="e_description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="e_coverImg" class="form-label">Cover Img</label>
                        <input type="file" class="form-control" id="e_coverImg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Cover Img</label>
                        <img id="e_currentCoverImg" class="img-fluid form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="e_price" class="form-label">Price - USD</label>
                        <input type="text" class="form-control" id="e_price">
                    </div>
                    <div class="mb-3">
                        <label for="e_category" class="form-label">Category</label>
                        <select class="form-control" id="e_category">
                            <?php
                            foreach ($data->categories as $value) { ?>
                                <option value=<?php echo $value['id'] ?>><?php echo $value['category_name'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="edit()">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are you sure to delete?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="remove()">Confirm</button>
            </div>
        </div>
    </div>
</div>


<!-- External Scripts -->
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
<script>
    let nEditor;
    ClassicEditor
        .create(document.querySelector('#n_description'), {
            toolbar: {
                items: [
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'blockQuote', 'codeBlock', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ]
            },
        }).then(newEditor => {
            nEditor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    let eEditor;
    ClassicEditor
        .create(document.querySelector('#e_description'), {
            toolbar: {
                items: [
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'blockQuote', 'codeBlock', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ]
            },
        }).then(newEditor => {
            eEditor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    const STORAGE_BASE_URL = "<?php echo STORAGE_BASE_URL . "/" ?>";
    let coverImgFile;

    $(function() {
        $('#n_coverImg').change(function() {
            var props = $('#n_coverImg').prop('files');
            file = props[0];
            coverImgFile = file;
        });

        $('#e_coverImg').change(function() {
            var props = $('#e_coverImg').prop('files');
            file = props[0];
            coverImgFile = file;
        });
    })

    function defineEditedItem(id) {
        coverImgFile = null;
        $('#editedItemId').val(id);

        $.ajax({
            method: "GET",
            url: `api/v1/product?id=${id}`,
            success: function(response) {
                if (response.status === 'ok') {
                    const {
                        name,
                        price,
                        short_description,
                        product_category_id,
                        cover_img,
                        description
                    } = response.data.product;
                    eEditor.setData(description);
                    $('#e_currentCoverImg').attr("src", `${STORAGE_BASE_URL}${cover_img}`);

                    $('#e_name').val(name);
                    $('#e_shortDescription').val(short_description);
                    $('#e_price').val(price);
                    $("#e_category").val(product_category_id);
                } else {
                    throw new Error("Process failed.")
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr);
                alert("Process failed.");
            }
        });
    }


    function defineDeletedItem(id) {
        $('#deletedItemId').val(id);
    }


    function add() {
        const nName = $('#n_name').val();
        const nShortDescription = $('#n_shortDescription').val();
        const nPrice = $('#n_price').val();
        const nCategoryId = $('#n_category').val();
        const nDescription = nEditor.getData();

        if (nName && nPrice && nCategoryId && nDescription && coverImgFile) {
            const formData = new FormData();
            formData.append('nName', nName);
            formData.append('nShortDescription', nShortDescription);
            formData.append('nPrice', nPrice);
            formData.append('nCategoryId', nCategoryId);
            formData.append('nDescription', nDescription);
            formData.append('coverImgFile', coverImgFile);
            $.ajax({
                method: "POST",
                url: 'api/v1/product',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully added.");
                        window.location.reload();
                    } else {
                        throw new Error("Process failed.")
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Process failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }

    function edit() {
        const id = $('#editedItemId').val();
        const eName = $('#e_name').val();
        const ePrice = $('#e_price').val();
        const eShortDescription = $('#e_shortDescription').val();
        const eCategoryId = $('#e_category').val();
        const eDescription = eEditor.getData();


        if (eName && ePrice && eCategoryId && eDescription) {
            const formData = new FormData();
            formData.append('eName', eName);
            formData.append('ePrice', ePrice);
            formData.append('eShortDescription', eShortDescription);
            formData.append('eCategoryId', eCategoryId);
            formData.append('eDescription', eDescription);
            coverImgFile && formData.append('coverImgFile', coverImgFile);
            $.ajax({
                method: "POST",
                url: `api/v1/product?id=${id}`,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully updated.");
                        window.location.reload();
                    } else {
                        throw new Error("Process failed.")
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Process failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }

    function remove() {
        const id = $('#deletedItemId').val();

        if (id) {
            $.ajax({
                method: "DELETE",
                url: `api/v1/product?id=${id}`,
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully removed.");
                        window.location.reload();
                    } else {
                        throw new Error("Process failed.")
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Process failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }
</script>