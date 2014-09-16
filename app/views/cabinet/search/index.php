<br />
<div>
    <form action="<?= URL::route('search-do') ?>" method="post">
        <label for="qInput">Строка</label>
        <input type="text" class="form-control" name="q" id="qInput" />
        <br />
        <label for="newInput">Новые</label>
        <input type="checkbox" name="status" value="new" id="newInput" />
        <label for="newInput">Новые</label>
        <input type="checkbox" name="status" value="new" id="newInput" />
    </form>
</div>