<header class="h-16 bg-white shadow-md flex items-center px-6 fixed pt-2 top-0 left-0 right-0 z-50" style="background-color: rgb(33, 37, 41);">
  <div class="text-gray-300 font-bold text-lg">
    Ivent
  </div>
  <div class="flex-1"></div> 
  <div class="flex items-center space-x-6">
    <span class="text-gray-300 font-medium">Halo, Admin {{ Auth::user()->username }}</span>

    <div class="relative">
      <img class="w-10 h-10 rounded-full" src="{{ asset('images/profileadmin.jpg') }}" alt="">
      <span class="top-0 left-7 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
    </div>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        Logout
      </button>
    </form>
  </div>
</header>