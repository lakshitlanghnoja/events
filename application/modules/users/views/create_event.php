<h3 class="text-center">Create your event</h3>
<form>
    <div class="form-group">
        <input type="text" class="form-control border-input" placeholder="Title">
    </div>
    <div class="form-group checkbox-outer radio-outer">
        <h4>Transportation</h4>
        <label for="radio-1">self</label>
        <input type="radio" name="radio" id="radio-1">
        <label for="radio-2">pickup only</label>
        <input type="radio" name="radio" id="radio-2">
        <label for="radio-3">pickup &amp; drop</label>
        <input type="radio" name="radio" id="radio-3">
    </div>
    <div class="form-group">
        <h4>Duration</h4>
        <div id="slider-tooltip"></div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <input type="text" id="datepicker1" class="form-control border-input" placeholder="Start Date">
        </div>
        <div class="form-group col-sm-6">
            <input type="text" id="datepicker2" class="form-control border-input" placeholder="End Date">
        </div>
    </div>
    <div class="form-group">
        <h4>Price</h4>
        <div id="price-slider"></div>
    </div>
    <div class="form-group">
        <textarea class="form-control border-input" placeholder="About Event"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-secondary btn-small">Create</button>
    </div>
</form>