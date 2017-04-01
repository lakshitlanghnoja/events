<div class="search-panel">
    <form class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter your destination">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="text" id="datepicker" class="form-control" placeholder="Date">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select class="custom-dropdown">
                        <option>Duration</option>
                        <option>Duration</option>
                        <option>Duration</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn-secondary">Search</button>
            </div>
        </div>
    </form>
</div>

<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2><?php echo($cms[0]['c']['title']);?></h2>
                <?php echo($cms[0]['c']['description']);?>
            </div>
        </div>
    </div>
</section>
