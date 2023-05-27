<form method="POST" action="{{ route('store_financial_year') }}">
    <div class="card-body">
        @csrf
        @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Financial Year</label>
                            <input required type="text" class="form-control" name="financial_year" placeholder="eg 2023/2024">
                        </div><!-- Col -->
                        <div class="col-md-6">
                            <label class="form-label">Year</label>
                            <input required type="text" class="form-control" name="year" placeholder="eg 2023">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Start Date</label>
                            <input required type="date" class="form-control" name="start_date" placeholder="Enter your Start Date">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">End Date</label>
                            <input required type="date" class="form-control" name="end_date" placeholder="Enter End Date">
                        </div><!-- Col -->
                        <div class="col-md-6 mt-3">
                            <label class="form-label">Status</label>
                            <select class="js-example-basic-single form-select" name="status" type="text" required>
                              <option selected >Active</option>
                              <option>Inactive</option>
                            </select>
                        </div>
                    </div><!-- Row -->
    </div>
    
</form>