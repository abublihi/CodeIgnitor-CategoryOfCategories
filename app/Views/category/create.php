<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
    <form action="/category/store" method="POST">
        <div class="mb-2">
            <label class="form-label" for="parent_id">Parent id (keep empty if you want to create a parent)</label>
            <input class="form-control" type="number" name="parent_id" id="parent_id">
        </div>
        <div class="mb-2">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" required>
        </div>
        <br>
        <input type="submit" value="submit" class="btn btn-success">
    </form>
<?= $this->endSection() ?>