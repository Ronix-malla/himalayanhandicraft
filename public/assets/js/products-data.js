// Himalayan Handcrafted Fine Jewelry - Product Catalog Database
const INITIAL_PRODUCTS_DATA = [
  {
    id: "ring-01",
    name: "Aethel Solitaire Hammered Gold Ring",
    category: "rings",
    categoryLabel: "Artisanal Rings",
    metal: "18K Gold Vermeil",
    metalKey: "gold",
    availableMetals: ["18K Gold Vermeil", "925 Sterling Silver", "Rose Gold"],
    price: 2499,
    originalPrice: 3200,
    rating: 4.9,
    reviewsCount: 48,
    badge: "Bestseller",
    image: "assets/images/prod-solitaire-ring.jpg",
    secondaryImage: "assets/images/cat-rings.jpg",
    sizes: ["US 5", "US 6", "US 7", "US 8", "US 9"],
    description: "Individually hand-hammered to catch the light from every angle. Features a bezel-set ethical lab-grown diamond on a solid recycled 18K gold vermeil band.",
    artisanNotes: "Hand-forged over 4 hours at our home jeweler bench. Finished with natural organic texture so no two rings are identical.",
    inStock: 5,
    isFeatured: true
  },
  {
    id: "bangle-01",
    name: "Sunburst Sculpted Fluted Gold Cuff",
    category: "bangles",
    categoryLabel: "Hand Bangles",
    metal: "18K Gold Vermeil",
    metalKey: "gold",
    availableMetals: ["18K Gold Vermeil", "Raw Brass", "925 Sterling Silver"],
    price: 4199,
    originalPrice: 5500,
    rating: 5.0,
    reviewsCount: 32,
    badge: "Signature Piece",
    image: "assets/images/cat-bangles.jpg",
    secondaryImage: "assets/images/prod-gold-cuff.jpg",
    sizes: ["2.4 (Small)", "2.6 (Medium)", "2.8 (Large)"],
    description: "A commanding yet lightweight open cuff bangle sculpted with fluted channels and organic hammered ends. Stacks effortlessly or makes a standalone statement.",
    artisanNotes: "Formed using antique dapping blocks and wooden mallets. Coated with micro-crystalline wax for enduring luster.",
    inStock: 3,
    isFeatured: true
  },
  {
    id: "ring-02",
    name: "Twisted Helix 925 Silver Band",
    category: "rings",
    categoryLabel: "Artisanal Rings",
    metal: "925 Sterling Silver",
    metalKey: "silver",
    availableMetals: ["925 Sterling Silver", "Oxidized Silver", "18K Gold Vermeil"],
    price: 1699,
    originalPrice: 2199,
    rating: 4.8,
    reviewsCount: 56,
    badge: "Hand-Hammered",
    image: "assets/images/prod-silver-ring.jpg",
    secondaryImage: "assets/images/cat-rings.jpg",
    sizes: ["US 5", "US 6", "US 7", "US 8", "US 9", "US 10"],
    description: "Two strands of solid 925 sterling silver wire hand-braided and forged into an unending Möbius loop. Stamped inside with hallmark 925 purity mark.",
    artisanNotes: "Annealed and hand-twisted under torch flame. Polished to a subtle satin sheen that patinas beautifully with time.",
    inStock: 8,
    isFeatured: true
  },
  {
    id: "bangle-02",
    name: "Bohemian Brass Stacking Bangles (Set of 3)",
    category: "bangles",
    categoryLabel: "Hand Bangles",
    metal: "Raw Brass",
    metalKey: "brass",
    availableMetals: ["Raw Brass", "18K Gold Vermeil", "925 Sterling Silver"],
    price: 1899,
    originalPrice: 2499,
    rating: 4.7,
    reviewsCount: 29,
    badge: "Set of 3",
    image: "assets/images/prod-brass-bangle.jpg",
    secondaryImage: "assets/images/cat-bangles.jpg",
    sizes: ["2.4 (Small)", "2.6 (Medium)", "2.8 (Large)"],
    description: "A trio of handcrafted brass bangles—one textured with tree bark striations, one high-polish smooth, and one beaded cord wire.",
    artisanNotes: "Crafted from nickel-free, solid jewelers brass that acquires an antique vintage patina. Cleans easily with lemon juice and salt.",
    inStock: 12,
    isFeatured: true
  },
  {
    id: "ring-03",
    name: "Celestial Aurora Rose Gold Band",
    category: "rings",
    categoryLabel: "Artisanal Rings",
    metal: "Rose Gold",
    metalKey: "rosegold",
    availableMetals: ["Rose Gold", "18K Gold Vermeil", "925 Sterling Silver"],
    price: 2299,
    originalPrice: 2899,
    rating: 4.9,
    reviewsCount: 37,
    badge: "New Arrival",
    image: "assets/images/prod-rose-ring.jpg",
    secondaryImage: "assets/images/cat-rings.jpg",
    sizes: ["US 5", "US 6", "US 7", "US 8"],
    description: "Warm blush tones of 14K rose gold over sterling silver. Designed with a soft contoured edge for maximum everyday comfort.",
    artisanNotes: "Hand-beveled on fine jeweler's files and diamond-buffed for an ultra-smooth glide on the finger.",
    inStock: 4,
    isFeatured: false
  },
  {
    id: "bangle-03",
    name: "Vedic Hammered Kada Bangle",
    category: "bangles",
    categoryLabel: "Hand Bangles",
    metal: "18K Gold Vermeil",
    metalKey: "gold",
    availableMetals: ["18K Gold Vermeil", "Raw Brass"],
    price: 3899,
    originalPrice: 4799,
    rating: 4.9,
    reviewsCount: 21,
    badge: "Heritage Craft",
    image: "assets/images/prod-gold-cuff.jpg",
    secondaryImage: "assets/images/cat-bangles.jpg",
    sizes: ["2.4 (Small)", "2.6 (Medium)", "2.8 (Large)"],
    description: "Inspired by royal heirloom kada traditions. Solid weight with heavy hand-textured diamond chiseling across the circumference.",
    artisanNotes: "Heavy gauge wire forged cold on a steel mandrel to impart remarkable strength and longevity.",
    inStock: 6,
    isFeatured: false
  },
  {
    id: "ring-04",
    name: "Vintage Filigree Lotus Ring",
    category: "rings",
    categoryLabel: "Artisanal Rings",
    metal: "Oxidized Silver",
    metalKey: "oxidized",
    availableMetals: ["Oxidized Silver", "925 Sterling Silver", "18K Gold Vermeil"],
    price: 1999,
    originalPrice: 2599,
    rating: 4.8,
    reviewsCount: 42,
    badge: "Vintage",
    image: "assets/images/prod-lotus-ring.jpg",
    secondaryImage: "assets/images/prod-silver-ring.jpg",
    sizes: ["US 6", "US 7", "US 8", "US 9"],
    description: "Intricate openwork filigree petaled band with antiqued oxidized crevices that accentuate every curved floral detail.",
    artisanNotes: "Treated with a specialized liver-of-sulfur patina wash and selectively hand-polished on the raised highlights.",
    inStock: 7,
    isFeatured: false
  },
  {
    id: "bangle-04",
    name: "Antiqued Tribal Silver Open Cuff",
    category: "bangles",
    categoryLabel: "Hand Bangles",
    metal: "Oxidized Silver",
    metalKey: "oxidized",
    availableMetals: ["Oxidized Silver", "925 Sterling Silver"],
    price: 3299,
    originalPrice: 4200,
    rating: 4.9,
    reviewsCount: 19,
    badge: "Artisan Choice",
    image: "assets/images/prod-oxidized-bangle.jpg",
    secondaryImage: "assets/images/cat-bangles.jpg",
    sizes: ["Adjustable One-Size (Fits 2.4 - 2.8)"],
    description: "An adjustable split cuff with stamped tribal chevron motifs along both borders and an oxidized vintage finish.",
    artisanNotes: "Individually die-stamped with hand-carved steel punches, then annealed for flexible sizing without metal fatigue.",
    inStock: 5,
    isFeatured: false
  },
  {
    id: "ring-05",
    name: "Elysian Emerald-Cut Signet Ring",
    category: "rings",
    categoryLabel: "Artisanal Rings",
    metal: "18K Gold Vermeil",
    metalKey: "gold",
    availableMetals: ["18K Gold Vermeil", "925 Sterling Silver"],
    price: 2799,
    originalPrice: 3500,
    rating: 5.0,
    reviewsCount: 14,
    badge: "Limited Edition",
    image: "assets/images/prod-signet-ring.jpg",
    secondaryImage: "assets/images/prod-solitaire-ring.jpg",
    sizes: ["US 6", "US 7", "US 8", "US 9", "US 10"],
    description: "A modern heirloom signet ring featuring a crisp emerald silhouette top plate, brushed satin finish, and tapered comfort shank.",
    artisanNotes: "Hand-cast in small batches of five. Can be worn plain or taken to a local engraver for custom initials.",
    inStock: 2,
    isFeatured: false
  },
  {
    id: "bangle-05",
    name: "Celeste Gemstone Beaded Bangle",
    category: "bangles",
    categoryLabel: "Hand Bangles",
    metal: "Raw Brass",
    metalKey: "brass",
    availableMetals: ["Raw Brass", "18K Gold Vermeil", "Rose Gold"],
    price: 2499,
    originalPrice: 3199,
    rating: 4.6,
    reviewsCount: 18,
    badge: "New Arrival",
    image: "assets/images/prod-gem-bangle.jpg",
    secondaryImage: "assets/images/cat-bangles.jpg",
    sizes: ["2.4 (Small)", "2.6 (Medium)", "2.8 (Large)"],
    description: "Delicate raw brass framework adorned with natural iridescent opal and moonstone beads wire-wrapped securely by hand.",
    artisanNotes: "Each gemstone bead is hand-selected for milky luminescence and wire-wrapped with 26-gauge craft wire.",
    inStock: 4,
    isFeatured: false
  }
];

// Initial demo users for collector management
const INITIAL_USERS_DATA = [
  {
    id: "usr-01",
    name: "Himalayan Admin",
    email: "admin@Himalayan.com",
    phone: "+91 98765 00000",
    role: "Admin",
    status: "Active",
    registeredAt: "2026-01-15T10:30:00Z"
  },
  {
    id: "usr-02",
    name: "Priya Sharma",
    email: "priya.sharma@Himalayan.demo",
    phone: "+91 98765 43210",
    role: "Collector",
    status: "Active",
    registeredAt: "2026-02-10T14:20:00Z"
  },
  {
    id: "usr-03",
    name: "Aarav Mehta",
    email: "aarav.m@example.com",
    phone: "+91 98111 22334",
    role: "Collector",
    status: "Active",
    registeredAt: "2026-02-28T09:15:00Z"
  },
  {
    id: "usr-04",
    name: "Ananya Patel",
    email: "ananya.p@example.com",
    phone: "+91 98450 67890",
    role: "Collector",
    status: "Active",
    registeredAt: "2026-03-05T16:45:00Z"
  },
  {
    id: "usr-05",
    name: "Vikramaditya Roy",
    email: "vikram.roy@domain.in",
    phone: "+91 99200 11223",
    role: "Collector",
    status: "Inactive",
    registeredAt: "2026-03-12T11:00:00Z"
  }
];

const PRODUCTS_STORAGE_KEY = "Himalayan_products_v1";
const USERS_STORAGE_KEY = "Himalayan_users_v1";

// Load products from localStorage with fallback to initial data
function loadStoredProducts() {
  try {
    const raw = localStorage.getItem(PRODUCTS_STORAGE_KEY);
    if (raw) {
      const parsed = JSON.parse(raw);
      if (Array.isArray(parsed) && parsed.length > 0) {
        return parsed;
      }
    }
  } catch (e) {
    console.error("Error reading products from localStorage", e);
  }
  try {
    localStorage.setItem(PRODUCTS_STORAGE_KEY, JSON.stringify(INITIAL_PRODUCTS_DATA));
  } catch (e) { }
  return JSON.parse(JSON.stringify(INITIAL_PRODUCTS_DATA));
}

// Load users from localStorage with fallback to initial users
function loadStoredUsers() {
  try {
    const raw = localStorage.getItem(USERS_STORAGE_KEY);
    if (raw) {
      const parsed = JSON.parse(raw);
      if (Array.isArray(parsed) && parsed.length > 0) {
        return parsed;
      }
    }
  } catch (e) {
    console.error("Error reading users from localStorage", e);
  }
  try {
    localStorage.setItem(USERS_STORAGE_KEY, JSON.stringify(INITIAL_USERS_DATA));
  } catch (e) { }
  return JSON.parse(JSON.stringify(INITIAL_USERS_DATA));
}

// Global active products data array
var PRODUCTS_DATA = loadStoredProducts();

// Synchronize global array in-place so all references stay updated
function syncProductsDataArray(newList) {
  PRODUCTS_DATA.length = 0;
  newList.forEach(item => PRODUCTS_DATA.push(item));
}

// Helper to retrieve all products
function getProducts() {
  const stored = loadStoredProducts();
  syncProductsDataArray(stored);
  return PRODUCTS_DATA;
}

// Helper to find product by id
function getProductById(id) {
  return getProducts().find(p => p.id === id);
}

// Save products to localStorage and update global array
function saveProducts(list) {
  try {
    localStorage.setItem(PRODUCTS_STORAGE_KEY, JSON.stringify(list));
    syncProductsDataArray(list);
    window.dispatchEvent(new CustomEvent("productsUpdated", { detail: { products: list } }));
    return true;
  } catch (e) {
    console.error("Failed saving products to localStorage", e);
    return false;
  }
}

// Add a new product
function addProduct(product) {
  const list = getProducts();
  list.unshift(product);
  saveProducts(list);
  return product;
}

// Update existing product
function updateProduct(id, updatedFields) {
  const list = getProducts();
  const index = list.findIndex(p => p.id === id);
  if (index !== -1) {
    list[index] = { ...list[index], ...updatedFields };
    saveProducts(list);
    return list[index];
  }
  return null;
}

// Delete product by id
function deleteProduct(id) {
  let list = getProducts();
  list = list.filter(p => p.id !== id);
  saveProducts(list);
  return list;
}

// Reset products to default seed data
function resetProductsToDefault() {
  saveProducts(JSON.parse(JSON.stringify(INITIAL_PRODUCTS_DATA)));
  return PRODUCTS_DATA;
}

// ==================== User Management Helpers ====================

// Retrieve all users
function getUsers() {
  return loadStoredUsers();
}

// Save users list
function saveUsers(list) {
  try {
    localStorage.setItem(USERS_STORAGE_KEY, JSON.stringify(list));
    window.dispatchEvent(new CustomEvent("usersUpdated", { detail: { users: list } }));
    return true;
  } catch (e) {
    console.error("Failed saving users to localStorage", e);
    return false;
  }
}

// Add user
function addUser(user) {
  const list = getUsers();
  list.unshift(user);
  saveUsers(list);
  return user;
}

// Update existing user
function updateUser(id, updatedFields) {
  const list = getUsers();
  const index = list.findIndex(u => u.id === id || u.email === id);
  if (index !== -1) {
    list[index] = { ...list[index], ...updatedFields };
    saveUsers(list);
    return list[index];
  }
  return null;
}

// Delete user
function deleteUser(id) {
  let list = getUsers();
  list = list.filter(u => u.id !== id && u.email !== id);
  saveUsers(list);
  return list;
}

// Reset users to default seed data
function resetUsersToDefault() {
  saveUsers(JSON.parse(JSON.stringify(INITIAL_USERS_DATA)));
  return INITIAL_USERS_DATA;
}

// Format price with INR currency symbol
function formatPrice(amount) {
  return "₹" + Number(amount).toLocaleString("en-IN");
}

