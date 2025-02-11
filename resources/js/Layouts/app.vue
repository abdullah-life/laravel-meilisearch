<template>
  <div class="dark:bg-slate-950 bg-slate-300 py-4 h-full min-h-screen" :class="isDark ? 'dark' : 'light'">
    <div class="p-4 md:p-8 lg:p-12 max-w-screen-2xl mx-auto">
      <!-- Header -->
      <header class="flex justify-between items-center text-slate-800 dark:text-slate-200 pb-6">
        <div class="flex items-center gap-4">
          <button 
            class="lg:hidden dark:bg-slate-900 bg-slate-100 rounded-lg p-2 border dark:border-slate-600 border-slate-300"
            @click="isMobileMenuOpen = !isMobileMenuOpen"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <div class="logo flex justify-start items-center gap-2">
            <svg class="size-10" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.1" fill-rule="evenodd" clip-rule="evenodd" d="M12 3C4.5885 3 3 4.5885 3 12C3 19.4115 4.5885 21 12 21C19.4115 21 21 19.4115 21 12C21 4.5885 19.4115 3 12 3ZM11.5 7.75C9.42893 7.75 7.75 9.42893 7.75 11.5C7.75 13.5711 9.42893 15.25 11.5 15.25C13.5711 15.25 15.25 13.5711 15.25 11.5C15.25 9.42893 13.5711 7.75 11.5 7.75Z" fill="currentColor"></path> <path d="M3 12C3 4.5885 4.5885 3 12 3C19.4115 3 21 4.5885 21 12C21 19.4115 19.4115 21 12 21C4.5885 21 3 19.4115 3 12Z" stroke="currentColor" stroke-width="2"></path> <path d="M14 14L16 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15 11.5C15 13.433 13.433 15 11.5 15C9.567 15 8 13.433 8 11.5C8 9.567 9.567 8 11.5 8C13.433 8 15 9.567 15 11.5Z" stroke="currentColor" stroke-width="2"></path> </g></svg>
            <h1 class="text-xl font-bold">Laravel Meilisearch</h1>
          </div>
        </div>
        
        <button 
          class="dark:bg-slate-900 bg-slate-100 rounded-lg p-3 border dark:border-slate-600 border-slate-300 transition-colors hover:bg-slate-200 dark:hover:bg-slate-800" 
          @click="toggleDark()"
        >
          <svg 
            v-if="isDark" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24"
            stroke-width="1.5" 
            stroke="currentColor" 
            class="size-4"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
          </svg>
          <svg 
            v-else 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            viewBox="0 0 24 24"
            stroke-width="1.5" 
            stroke="currentColor" 
            class="size-4"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
          </svg>
        </button>
      </header>

      <!-- Main Content -->
      <section class="flex flex-col lg:flex-row justify-start gap-4">
        <!-- Sidebar -->
        <section
          :class="[
            'rounded-3xl border dark:border-slate-600 border-slate-300 dark:bg-slate-900 bg-white p-6 transition-all duration-300',
            'lg:w-1/4',
            isMobileMenuOpen ? 'fixed inset-0 z-50 m-4' : 'hidden lg:block'
          ]"
        >
          <!-- Mobile Close Button -->
          <button 
            v-if="isMobileMenuOpen"
            class="lg:hidden absolute top-4 right-4 p-2 rounded-lg dark:bg-slate-800 bg-slate-100"
            @click="isMobileMenuOpen = false"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <ul class="space-y-2 p-8">
            <li v-for="route in navigationRoutes" :key="route.path">
              <a 
                :href="route.path"
                :class="[
                  'w-full block p-4 rounded transition-colors duration-200',
                  isActive(route.hash) ? 
                    'dark:bg-white bg-slate-500 text-slate-200 dark:text-slate-800' : 
                    'bg-slate-700 text-slate-200 hover:bg-slate-600'
                ]"
                @click="handleNavigation(route.hash)"
              >
                {{ route.label }}
              </a>
            </li>
          </ul>
        </section>

        <!-- Mobile Menu Backdrop -->
        <div 
          v-if="isMobileMenuOpen"
          class="fixed inset-0 bg-black/50 z-40 lg:hidden"
          @click="isMobileMenuOpen = false"
        ></div>

        <!-- Content Area -->
        <transition name="fade" mode="out-in">
          <component 
            :is="currentView.component"
            class="w-full lg:w-3/4 rounded-3xl border dark:border-slate-600 border-slate-300 dark:bg-slate-900 bg-white p-6"
            v-bind="currentView.params" 
          />
        </transition>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import Home from "@/Pages/Home.vue";
import About from "@/Pages/About.vue";
import NotFound from "@/Pages/NotFound.vue";
import Product from "@/Pages/Product.vue";
import Index from "@/Pages/Index.vue";
import { useDark, useToggle } from '@vueuse/core';

const isDark = useDark();
const toggleDark = useToggle(isDark);
const isMobileMenuOpen = ref(false);
const currentPath = ref(window.location.hash);

// Routes configuration
const routes = {
  "/": Home,
  "/about": About,
  "/product/:id": Product,
  "/index/:uid": Index,
  "/index": Index,
};

// Navigation routes array
const navigationRoutes = [
  { path: '/laravel-meilisearch/#/', hash: '#/', label: 'Home' },
  { path: '#/index', hash: '#/index', label: 'Indexes' },
  { path: '#/tasks', hash: '#/tasks', label: 'Tasks' },
  { path: '#/product/2', hash: '#/product/2', label: 'Product 2' },
  { path: '#/about', hash: '#/about', label: 'About' },
];

// Handle window resize
const handleResize = () => {
  if (window.innerWidth >= 1024) {
    isMobileMenuOpen.value = false;
  }
};

onMounted(() => {
  // Initialize path
  if (currentPath.value === "") {
    currentPath.value = "#/";
    window.location.hash = "/";
  }

  // Event listeners
  window.addEventListener("hashchange", () => {
    currentPath.value = window.location.hash;
  });
  window.addEventListener("resize", handleResize);
});

onBeforeUnmount(() => {
  window.removeEventListener("resize", handleResize);
});

const handleNavigation = (hash) => {
  currentPath.value = hash;
  isMobileMenuOpen.value = false;
};

const isActive = (path) => {
  return currentPath.value === path;
};

const currentView = computed(() => {
  const pathParts = currentPath.value.slice(1).split("/");
  let route = routes["*"] || NotFound;
  let params = {};

  // Find matching route based on path parts
  for (const routePath in routes) {
    const routeParts = routePath.split("/");
    if (routeParts.length === pathParts.length) {
      let match = true;
      for (let i = 0; i < routeParts.length; i++) {
        if (routeParts[i].startsWith(":")) {
          params[routeParts[i].slice(1)] = pathParts[i];
        } else if (routeParts[i] !== pathParts[i]) {
          match = false;
          break;
        }
      }
      if (match) {
        route = routes[routePath];
        break;
      }
    }
  }

  // Extract query parameters
  const queryString = window.location.search.substring(1);
  queryString.split("&").forEach((pair) => {
    const [key, value] = pair.split("=");
    if (key) {
      params[key] = decodeURIComponent(value);
    }
  });

  return {
    component: route,
    params,
  };
});
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: all 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}

@media (max-width: 1024px) {
  .fade-enter-from,
  .fade-leave-to {
    transform: translateX(10px);
  }
}
</style>