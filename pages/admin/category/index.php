<?php
$__cssLinks = ['styles/pages/admin/category.css'];

$data = CategoryController::getData();

?>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 d-flex justify-content-center my-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data->categories as $value) {
                if (is_array($value)) { ?>
                    <tr>
                        <th scope="row"><?php echo $value['id'] ?></th>
                        <td><?php echo $value['category_name'] ?></td>
                        <td><?php echo $value['created_at'] ?></td>
                        <td><?php echo $value['updated_at'] ?></td>
                        <td><button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#editModal" onclick="defineEditedItem(<?php echo $value['id']; ?>)">Edit</button><button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="defineDeletedItem(<?php echo $value['id']; ?>)">Delete</button></td>
                    </tr>
            <?php }
            }
            ?>
        </tbody>
    </table>
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
                        <label for="newCategoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="newCategoryName">
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
                        <label for="editedCategoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editedCategoryName">
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


<script>
    function defineEditedItem(id) {
        $('#editedItemId').val(id);

        $.ajax({
            method: "GET",
            url: `api/v1/category?id=${id}`,
            success: function(response) {
                if (response.status === 'ok') {
                    $('#editedCategoryName').val(response.data.category.category_name);
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
        const newCategoryName = $('#newCategoryName').val();

        if (newCategoryName) {
            $.ajax({
                method: "POST",
                url: 'api/v1/category',
                data: {
                    newCategoryName,
                },
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
        const editedCategoryName = $('#editedCategoryName').val();

        if (editedCategoryName) {
            $.ajax({
                method: "PUT",
                url: `api/v1/category?id=${id}`,
                data: JSON.stringify({
                    editedCategoryName,
                }),
                contentType: 'application/json',
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
                url: `api/v1/category?id=${id}`,
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