<form method="POST" action="{{ route('store_financial_year') }}">
    <div class="card-body">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="name">Year</label>
                    <input required type="text" class="form-control" name="name" placeholder="eg 2023/2024">
                </div>
            </div><!-- Col -->
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="start_date">Start Date</label>
                    <input required type="date" class="form-control" name="start_date" placeholder="Enter your Start Date">
                </div>
            </div><!-- Col -->
            <div class="col-sm-4">
                <div class="mb-3">
                    <label class="form-label" for="end_date">End Date</label>
                    <input required type="date" class="form-control" name="end_date" placeholder="Enter End Date">
                </div>
            </div><!-- Col -->
        </div><!-- Row -->
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success submit">Submit form</button>
    </div>
</form>