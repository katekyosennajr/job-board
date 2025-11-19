<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const mobileMenuOpen = ref(false);
const authDropdownOpen = ref(false);

const isLoggedIn = computed(() => !!page.props.auth.user);
const userRole = computed(() => page.props.auth.user?.role);

</script>

<template>
  <nav class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-14">
        
        <!-- Logo -->
        <Link href="/" class="flex items-center gap-2 font-semibold text-base text-indigo-600">
          <div class="w-7 h-7 bg-indigo-600 rounded-md flex items-center justify-center text-white text-sm font-bold">J</div>
          JobBoard
        </Link>

        <!-- Auth Buttons / User Menu -->
        <div class="flex items-center gap-3">
          <template v-if="!isLoggedIn">
            <Link
              :href="route('login')"
              class="text-slate-700 hover:text-indigo-600 text-sm font-medium transition"
            >
              Masuk
            </Link>
            <Link
              :href="route('register')"
              class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium"
            >
              Daftar
            </Link>
          </template>
          <template v-else>
            <Link
              :href="route('dashboard')"
              class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm font-medium"
            >
              Dashboard
            </Link>
            <div class="relative group">
              <button class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-semibold hover:bg-indigo-200 transition">
                {{ page.props.auth.user.name.charAt(0).toUpperCase() }}
              </button>
              <div class="absolute right-0 mt-1 w-44 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all border border-slate-200">
                <Link
                  :href="userRole === 'company' ? route('company.profile.edit') : route('profile.edit')"
                  class="block px-3 py-2.5 text-slate-700 hover:bg-slate-50 transition text-sm font-medium rounded-t-md"
                >
                  Profil
                </Link>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="w-full text-left px-3 py-2.5 text-slate-700 hover:bg-slate-50 transition text-sm font-medium rounded-b-md border-t border-slate-200"
                >
                  Keluar
                </Link>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>
