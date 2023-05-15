<form action="{{ route('store_subcounty') }}" method="POST">
    @csrf
    <div class="row ms-2">

        <div class="col-md-6">
            <label for="exampleInputUsername2" class="mb-2">Subcounty Name</label>
            <input type="text" name="subcounty_name" class="form-control" placeholder="Enter Subcounty Name" required>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputUsername2" class="mb-2">County Name</label>
                <select class="js-example-basic-single form-select" data-width="100%" name="county_id" id="counties">
                    @foreach ($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->county_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>   

        <div>
            <button type="submit" class="btn btn-primary mt-3">Add Subcounty <span style="position: relative; top:2px; left: 2px"><ion-icon name="add-circle-outline"></ion-icon></span></button>
        </div>
    </div>

</form>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/tags-input.js') }}"></script>
  <script src="{{ asset('assets/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/js/dropify.js') }}"></script>
  <script src="{{ asset('assets/js/pickr.js') }}"></script>
  <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
