

<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <div class="flex items-center">
        <div class="shrink-0">
          <img class="size-8" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
        </div>
        <div class="hidden md:block">
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="/" class="<?= isUri('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Home</a>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
              <a href="/todos" class="<?= isUri('/todos') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Todos</a>
            <?php else : ?>
              <a href="/register" class="<?= isUri('/register') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Register</a>
              <a href="/login" class="<?= isUri('/login') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> rounded-md px-3 py-2 text-sm font-medium">Login</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
            <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
              </svg>
            </button>

            <form action="/logout" method="POST" class="ml-4">
              <input type="hidden" name="_method" value="DELETE" />
              <button class="rounded-md bg-gray-700 px-3 py-2 text-sm font-medium text-white hover:bg-gray-600">Sign out</button>
            </form>

            <div class="relative ml-3">
              <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="">
              </button>

              <div class="absolute hidden right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5" role="menu" aria-labelledby="user-menu-button">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                <form action="/logout" method="POST">
                  <input type="hidden" name="_method" value="DELETE" />
                  <button class="block px-4 py-2 text-sm text-gray-700">Sign out</button>
                </form>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="-mr-2 flex md:hidden">
        <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div class="md:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
      <a href="/" class="<?= isUri('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium">Home</a>
      <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
        <a href="/todos" class="<?= isUri('/todos') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium">Todos</a>
      <?php else : ?>
        <a href="/register" class="<?= isUri('/register') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium">Register</a>
        <a href="/login" class="<?= isUri('/login') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' ?> block rounded-md px-3 py-2 text-base font-medium">Login</a>
      <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']) : ?>
      <div class="border-t border-gray-700 pt-4 pb-3">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-white">Tom Cook</div>
            <div class="text-sm font-medium text-gray-400">tom@example.com</div>
          </div>
          <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082..." />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <form action="/logout" method="POST">
            <input type="hidden" name="_method" value="DELETE" />
            <button class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</button>
          </form>
        </div>
      </div>
    <?php endif; ?>
  </div>
</nav>

