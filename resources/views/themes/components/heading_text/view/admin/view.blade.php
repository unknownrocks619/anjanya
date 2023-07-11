<div class="row">
    <div class="col-md-12">
        <?php
        $values = json_decode($component->values);
        ?>
        <{{ $values->title_size }}>{{ $values->title }}</{{ $values->title_size }}>
    </div>
</div>
