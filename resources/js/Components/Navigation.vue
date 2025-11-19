<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const mobileMenuOpen = ref(false);

const isLoggedIn = computed(() => !!page.props.auth.user);
const userRole = computed(() => page.props.auth.user?.role);

const navLinks = [
  { label: 'Cari Kerja', href: route('jobs.index'), icon: 'briefcase' },
  { label: 'Perusahaan', href: '/#companies', icon: 'building' },
];

const dashboardLink = computed(() => {
  if (!isLoggedIn.value) return null;
  return route('dashboard');
});
</script>

<template>
  <nav class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        
        <!-- Logo -->
        <Link href="/" class="flex items-center gap-2 font-bold text-xl text-primary-600">
          <div class="w-8 h-8 bg-primary-600 rounded-lg"></div>
          JobBoard
        </Link>

        <!-- Desktop Nav -->
        <div class="hidden md:flex items-center gap-8">
          <Link
            v-for="link in navLinks"
            :key="link.href"
            :href="link.href"
            class="text-slate-600 hover:text-primary-600 transition-colors font-medium"
          >
            {{ link.label }}
          </Link>
        </div>

        <!-- Auth Buttons / User Menu -->
        <div class="flex items-center gap-4">
          <template v-if="!isLoggedIn">
            <Link
              :href="route('login')"
              class="text-slate-600 hover:text-primary-600 font-medium"
            >
              Masuk
            </Link>
            <Link
              :href="route('register')"
              class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium"
            >
              Daftar
            </Link>
          </template>
          <template v-else>
            <Link
              :href="dashboardLink"
              class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors font-medium"
            >
              Dashboard
            </Link>
            <div class="relative group">
              <button class="w-10 h-10 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                {{ page.props.auth.user.name.charAt(0).toUpperCase() }}
              </button>
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                <Link
                  :href="route('profile.edit')"
                  class="block px-4 py-2 text-slate-700 hover:bg-slate-50 rounded-t-lg"
                >
                  Profil
                </Link>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="w-full text-left px-4 py-2 text-slate-700 hover:bg-slate-50 rounded-b-lg border-t border-slate-200"
                >
                  Keluar
                </Link>
              </div>
            </div>
          </template>
        </div>

        <!-- Mobile menu button -->
        <button
          @click="mobileMenuOpen = !mobileMenuOpen"
          class="md:hidden p-2 text-slate-600"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Mobile Menu -->
      <div v-if="mobileMenuOpen" class="md:hidden pb-4 space-y-2">
        <Link
          v-for="link in navLinks"
          :key="link.href"
          :href="link.href"
          class="block px-4 py-2 text-slate-600 hover:bg-primary-50 rounded-lg"
        >
          {{ link.label }}
        </Link>
      </div>
    </div>
  </nav>
</template>
