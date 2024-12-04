<footer class="bg-dark text-white mt-5 py-4">
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <h5>{{__('msgs.About Us')}}</h5>
              <p>{{__('msgs.About Text')}}</p>
          </div>
          <div class="col-md-4">
              <h5>{{__('msgs.Quick Links')}}</h5>
              <ul class="list-unstyled">
                  <li><a href="{{url('privacy')}}" class="text-white text-decoration-none">{{__('msgs.Privacy Policy')}}</a></li>
                  <li><a href="{{url('conditions')}}" class="text-white text-decoration-none">{{__('msgs.Terms & Conditions')}}</a></li>
              </ul>
          </div>
          <div class="col-md-4">
              <h5><a href="{{url('contact')}}" class="text-white text-decoration-none">{{__('msgs.Contact Us')}}</a></h5>
              <p>Email: contact@blogsite.com</p>
              <p>Phone: +123 456 7890</p>
          </div>
      </div>
      <div class="text-center mt-3">
          <p>&copy; 2024 BlogSite {{__('msgs.Rights Reserved')}}.</p>
      </div>
  </div>
</footer>