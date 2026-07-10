<form method="get"
  action="{{ route('students.index') }}"
  class="mb-3">
  <div class="card">
    <div class="card-body">
      <div class="d-flex align-items-end">
        <div class="row gy-3 flex-fill">
          <div class="col-lg-8">
            <label for="keyword"
              class="form-label">First Name</label>
            <input type="text"
              id="keyword"
              name="filter[keyword]"
              value="{{ request('filter.keyword') }}"
              class="form-control form-control-sm"
              placeholder="Enter first, middle, last name, email, or contact number"
              autofocus />
          </div>
          <div class="col-lg-4">
            <label for="scholarship_accredited"
              class="form-label">Scholarship Accredited</label>
            <select id="scholarship_accredited"
              name="filter[scholarship_accredited]"
              class="form-control form-select form-select-sm text-capitalize">
              <option value=""
                @selected(!request('filter.scholarship_accredited'))>- Select an option... -</option>
              <option value="yes"
                @selected(request('filter.scholarship_accredited') == 'yes')>Yes</option>
              <option value="no"
                @selected(request('filter.scholarship_accredited') == 'no')>No</option>
            </select>
          </div>
          <div class="col-lg-4">
            <label for="gender"
              class="form-label">Gender</label>
            <select id="gender"
              name="filter[gender]"
              class="form-control form-select form-select-sm text-capitalize">
              <option value=""
                @selected(!request('filter.gender'))>- Select an option... -</option>
              @foreach ($genders as $gender)
                <option value="{{ $gender }}"
                  @selected(request('filter.gender') == $gender)>{{ $gender }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-lg-4">
            <label for="course_id"
              class="form-label">Course</label>
            <select id="course_id"
              name="filter[course]"
              class="form-control form-select form-select-sm">
              <option value=""
                @selected(!request('filter.course'))>- Select an option... -</option>
              @foreach ($courses as $course)
                <option value="{{ $course->id }}"
                  @selected(request('filter.course') == $course->id)>{{ $course->code . ' - ' . $course->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div>
          <button type="submit"
            class="btn btn-sm btn-secondary">Apply Filter</button>
          &nbsp;
          <a href="{{ route('students.index') }}"
            role="button"
            class="btn btn-sm btn-outline-secondary">Clear Filter</a>
        </div>
      </div>
    </div>
  </div>


  <pre class="mt-3 bg-secondary p-2 rounded text-white">{{ $query->toRawSql() }}</pre>

</form>
