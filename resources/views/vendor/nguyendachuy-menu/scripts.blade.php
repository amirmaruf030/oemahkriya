<script> 
	var URL_CREATE_ITEM_MENU = "{{ route('h-menu.add-item') }}";
	var URL_DELETE_ITEM_MENU = "{{ route('h-menu.delete-item') }}";
	var URL_UPDATE_ITEM_MENU = "{{ route('h-menu.update-item') }}";

	var URL_CREATE_MENU = "{{ route('h-menu.create-menu') }}";
	var URL_UPDATE_ITEMS_AND_MENU = "{{ route('h-menu.update-menu-and-items') }}";
	var URL_DELETE_MENU = "{{ route('h-menu.delete-menu') }}";
	
	var URL_CURRENT = "{{ url()->current() }}";
	var URL_FULL = "{{ request()->fullUrl() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		}
	});
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/nestable2@1.6.0/jquery.nestable.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/nguyendachuy-menu/menu.js')}}"></script>