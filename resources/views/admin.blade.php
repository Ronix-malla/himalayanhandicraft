@extends('layouts.front')

@section('title', 'Atelier Admin Dashboard — Himalayan Handcrafted Fine Jewelry')

@section('content')
  <!-- Admin Header Section -->
  <header class="py-5 bg-warm-secondary border-bottom border-warm">
    <div class="container">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
          <div class="d-flex align-items-center gap-2 mb-1">
            <span class="badge bg-gold text-white px-2 py-1 small">Atelier Management</span>
            <span class="text-muted small">Jaipur Home Studio</span>
          </div>
          <h1 class="display-6 font-serif mb-1">Artisan Administration</h1>
          <p class="text-muted small mb-0">Oversee orders, update piece inventories, and monitor collector inquiries.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
          <button type="button" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-circle me-1"></i> Add New Creation
          </button>
          <a href="{{ route('products.index') }}" class="btn btn-outline-dark" target="_blank">
            <i class="bi bi-box-arrow-up-right me-1"></i> View Live Shop
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Admin Main Content -->
  <main class="py-5">
    <div class="container">

      <!-- Metrics Overview Cards -->
      <div class="row g-4 mb-5">
        <div class="col-sm-6 col-lg-3">
          <div class="card border-warm shadow-subtle p-4 bg-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="text-muted small fw-semibold text-uppercase letter-spacing-wide">Total Revenue</span>
              <div class="rounded-circle bg-warm-secondary p-2 text-gold-accent">
                <i class="bi bi-currency-rupee fs-5"></i>
              </div>
            </div>
            <h3 class="font-serif mb-1 text-ink">₹{{ number_format($totalRevenue, 2) }}</h3>
            <span class="x-small text-muted">From {{ $totalOrders }} placed orders</span>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="card border-warm shadow-subtle p-4 bg-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="text-muted small fw-semibold text-uppercase letter-spacing-wide">Orders</span>
              <div class="rounded-circle bg-warm-secondary p-2 text-gold-accent">
                <i class="bi bi-bag-check fs-5"></i>
              </div>
            </div>
            <h3 class="font-serif mb-1 text-ink">{{ $totalOrders }}</h3>
            <span class="x-small text-muted">All active & fulfilled</span>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="card border-warm shadow-subtle p-4 bg-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="text-muted small fw-semibold text-uppercase letter-spacing-wide">Catalog Pieces</span>
              <div class="rounded-circle bg-warm-secondary p-2 text-gold-accent">
                <i class="bi bi-gem fs-5"></i>
              </div>
            </div>
            <h3 class="font-serif mb-1 text-ink">{{ $totalProducts }}</h3>
            <span class="x-small text-muted">Rings, Cuffs & Stacks</span>
          </div>
        </div>

        <div class="col-sm-6 col-lg-3">
          <div class="card border-warm shadow-subtle p-4 bg-card h-100">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <span class="text-muted small fw-semibold text-uppercase letter-spacing-wide">Inquiries</span>
              <div class="rounded-circle bg-warm-secondary p-2 text-gold-accent">
                <i class="bi bi-chat-heart fs-5"></i>
              </div>
            </div>
            <h3 class="font-serif mb-1 text-ink">{{ $totalInquiries }}</h3>
            <span class="x-small text-muted">Sizing & bespoke messages</span>
          </div>
        </div>
      </div>

      <!-- Navigation Tabs -->
      <ul class="nav admin-nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#ordersPane" type="button" role="tab">
            <i class="bi bi-bag-check"></i> Orders ({{ count($orders) }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="products-tab" data-bs-toggle="tab" data-bs-target="#productsPane" type="button" role="tab">
            <i class="bi bi-gem"></i> Jewelry Catalog ({{ count($products) }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="inquiries-tab" data-bs-toggle="tab" data-bs-target="#inquiriesPane" type="button" role="tab">
            <i class="bi bi-chat-left-text"></i> Inquiries ({{ count($inquiries) }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#usersPane" type="button" role="tab">
            <i class="bi bi-people"></i> Collectors & Users ({{ count($users) }})
          </button>
        </li>
      </ul>

      <!-- Tab Content Panes -->
      <div class="tab-content" id="adminTabsContent">

        <!-- 1. ORDERS PANE -->
        <div class="tab-pane fade show active" id="ordersPane" role="tabpanel">
          <div class="card border-warm shadow-subtle p-0 overflow-hidden bg-card">
            <div class="p-3 bg-warm-secondary border-bottom border-warm d-flex justify-content-between align-items-center">
              <h5 class="font-serif mb-0">Client Orders</h5>
              <span class="small text-muted">Live orders synced from checkout</span>
            </div>
            <div class="table-responsive">
              <table class="table-admin mb-0">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Destination</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($orders as $order)
                    <tr>
                      <td class="fw-bold text-ink">
                        <span>{{ $order->order_number }}</span>
                        <div class="x-small text-muted">{{ $order->created_at->format('M d, Y H:i') }}</div>
                      </td>
                      <td>
                        <div class="fw-semibold text-ink">{{ $order->customer_name }}</div>
                        <div class="x-small text-muted">{{ $order->customer_phone }}</div>
                        <div class="x-small text-muted">{{ $order->customer_email }}</div>
                      </td>
                      <td>
                        <div class="small">{{ $order->city }}, {{ $order->state }}</div>
                        <div class="x-small text-muted text-truncate" style="max-width: 180px;">{{ $order->street_address }}</div>
                      </td>
                      <td>
                        <div class="small">
                          @foreach($order->items as $item)
                            <div class="mb-1">
                              • {{ $item->product_name }}
                              <span class="x-small text-muted">({{ $item->metal }}, {{ $item->size }}) × {{ $item->quantity }}</span>
                            </div>
                          @endforeach
                        </div>
                      </td>
                      <td class="fw-bold text-gold-accent">
                        ₹{{ number_format($order->total_amount, 2) }}
                      </td>
                      <td>
                        <span class="badge bg-warm-secondary text-ink border border-warm text-uppercase">
                          {{ $order->payment_method }}
                        </span>
                      </td>
                      <td>
                        @php
                          $badgeClass = match($order->order_status) {
                            'confirmed' => 'bg-info text-dark',
                            'processing' => 'bg-warning text-dark',
                            'shipped' => 'bg-primary text-white',
                            'delivered' => 'bg-success text-white',
                            'cancelled' => 'bg-danger text-white',
                            default => 'bg-secondary text-white'
                          };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                          {{ ucfirst($order->order_status) }}
                        </span>
                      </td>
                      <td>
                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PUT')
                          <select name="order_status" class="form-select form-select-sm border-warm d-inline-block" style="width: 120px;" onchange="this.form.submit()">
                            <option value="confirmed" {{ $order->order_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->order_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                          </select>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center py-4 text-muted">No orders placed yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- 2. PRODUCTS / CATALOG PANE -->
        <div class="tab-pane fade" id="productsPane" role="tabpanel">
          <div class="card border-warm shadow-subtle p-0 overflow-hidden bg-card">
            <div class="p-3 bg-warm-secondary border-bottom border-warm d-flex justify-content-between align-items-center">
              <h5 class="font-serif mb-0">Artisanal Pieces Inventory</h5>
              <button type="button" class="btn btn-sm btn-gold" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg me-1"></i> Add Piece
              </button>
            </div>
            <div class="table-responsive">
              <table class="table-admin mb-0">
                <thead>
                  <tr>
                    <th>Piece</th>
                    <th>Category</th>
                    <th>Metal</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($products as $product)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center gap-3">
                          <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="admin-thumb" onerror="this.src='{{ asset('assets/images/prod-solitaire-ring.jpg') }}'">
                          <div>
                            <div class="fw-semibold text-ink">{{ $product->name }}</div>
                            <div class="x-small text-muted">SKU: {{ $product->code ?? 'N/A' }}</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-warm-secondary text-ink border border-warm">
                          {{ $product->categoryLabel }}
                        </span>
                      </td>
                      <td>
                        <span class="small">{{ $product->metal }}</span>
                      </td>
                      <td class="fw-bold text-ink">
                        ₹{{ number_format($product->price, 2) }}
                        @if($product->original_price)
                          <div class="x-small text-muted text-decoration-line-through">₹{{ number_format($product->original_price, 2) }}</div>
                        @endif
                      </td>
                      <td>
                        <span class="badge {{ $product->in_stock > 3 ? 'bg-success' : 'bg-danger' }}">
                          {{ $product->in_stock }} in stock
                        </span>
                      </td>
                      <td>
                        <span class="small text-warning"><i class="bi bi-star-fill me-1"></i>{{ $product->rating }}</span>
                        <span class="x-small text-muted">({{ $product->reviews_count }})</span>
                      </td>
                      <td>
                        @if($product->is_featured)
                          <span class="badge bg-gold text-white">Featured</span>
                        @endif
                        @if($product->badge)
                          <span class="badge bg-secondary">{{ $product->badge }}</span>
                        @endif
                      </td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                            <i class="bi bi-pencil"></i>
                          </button>
                          <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Remove this piece from catalog?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>

                    <!-- Edit Product Modal -->
                    <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-warm">
                          <div class="modal-header border-warm">
                            <h5 class="modal-title font-serif">Edit Piece: {{ $product->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body p-4">
                              <div class="row g-3">
                                <div class="col-md-8">
                                  <label class="form-label small fw-semibold">Piece Name</label>
                                  <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                </div>
                                <div class="col-md-4">
                                  <label class="form-label small fw-semibold">Category</label>
                                  <select name="category" class="form-select" required>
                                    <option value="rings" {{ $product->category === 'rings' ? 'selected' : '' }}>Artisanal Rings</option>
                                    <option value="bangles" {{ $product->category === 'bangles' ? 'selected' : '' }}>Hand Bangles & Cuffs</option>
                                  </select>
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label small fw-semibold">Metal Description</label>
                                  <input type="text" name="metal" class="form-control" value="{{ $product->metal }}" required>
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label small fw-semibold">Metal Key (Filter)</label>
                                  <select name="metal_key" class="form-select" required>
                                    <option value="gold" {{ $product->metal_key === 'gold' ? 'selected' : '' }}>18K Gold Vermeil</option>
                                    <option value="silver" {{ $product->metal_key === 'silver' ? 'selected' : '' }}>925 Sterling Silver</option>
                                    <option value="brass" {{ $product->metal_key === 'brass' ? 'selected' : '' }}>Raw Brass</option>
                                    <option value="rosegold" {{ $product->metal_key === 'rosegold' ? 'selected' : '' }}>Rose Gold</option>
                                    <option value="oxidized" {{ $product->metal_key === 'oxidized' ? 'selected' : '' }}>Oxidized Silver</option>
                                  </select>
                                </div>
                                <div class="col-md-4">
                                  <label class="form-label small fw-semibold">Price (₹)</label>
                                  <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                                </div>
                                <div class="col-md-4">
                                  <label class="form-label small fw-semibold">Original Price (₹)</label>
                                  <input type="number" step="0.01" name="original_price" class="form-control" value="{{ $product->original_price }}">
                                </div>
                                <div class="col-md-4">
                                  <label class="form-label small fw-semibold">Stock Quantity</label>
                                  <input type="number" name="in_stock" class="form-control" value="{{ $product->in_stock }}" required>
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label small fw-semibold">Badge (Optional)</label>
                                  <input type="text" name="badge" class="form-control" value="{{ $product->badge }}">
                                </div>
                                <div class="col-md-6">
                                  <label class="form-label small fw-semibold">Image Path</label>
                                  <input type="text" name="image" class="form-control" value="{{ $product->image }}">
                                </div>
                                <div class="col-12">
                                  <label class="form-label small fw-semibold">Description</label>
                                  <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
                                </div>
                                <div class="col-12">
                                  <label class="form-label small fw-semibold">Artisan Notes</label>
                                  <textarea name="artisan_notes" class="form-control" rows="2">{{ $product->artisan_notes }}</textarea>
                                </div>
                                <div class="col-12">
                                  <div class="form-check">
                                    <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="feat{{ $product->id }}" {{ $product->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="feat{{ $product->id }}">Feature on Homepage Strip</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer border-warm">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                              <button type="submit" class="btn btn-gold">Save Changes</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  @empty
                    <tr>
                      <td colspan="8" class="text-center py-4 text-muted">No products found in catalog.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- 3. INQUIRIES PANE -->
        <div class="tab-pane fade" id="inquiriesPane" role="tabpanel">
          <div class="card border-warm shadow-subtle p-0 overflow-hidden bg-card">
            <div class="p-3 bg-warm-secondary border-bottom border-warm">
              <h5 class="font-serif mb-0">Collector Inquiries & Sizing Messages</h5>
            </div>
            <div class="table-responsive">
              <table class="table-admin mb-0">
                <thead>
                  <tr>
                    <th>From</th>
                    <th>Topic</th>
                    <th>Message</th>
                    <th>Received</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($inquiries as $inq)
                    <tr>
                      <td>
                        <div class="fw-semibold text-ink">{{ $inq->name }}</div>
                        <div class="x-small text-muted">{{ $inq->email }}</div>
                        @if($inq->phone)
                          <div class="x-small text-muted">{{ $inq->phone }}</div>
                        @endif
                      </td>
                      <td>
                        <span class="badge bg-warm-secondary text-ink border border-warm">{{ $inq->subject }}</span>
                      </td>
                      <td style="max-width: 320px;">
                        <div class="small text-muted">{{ $inq->message }}</div>
                      </td>
                      <td>
                        <div class="small">{{ $inq->created_at->format('M d, Y') }}</div>
                        <div class="x-small text-muted">{{ $inq->created_at->diffForHumans() }}</div>
                      </td>
                      <td>
                        @php
                          $inqClass = match($inq->status) {
                            'new' => 'bg-danger text-white',
                            'read' => 'bg-warning text-dark',
                            'replied' => 'bg-success text-white',
                            default => 'bg-secondary'
                          };
                        @endphp
                        <span class="badge {{ $inqClass }}">{{ ucfirst($inq->status) }}</span>
                      </td>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <form action="{{ route('admin.inquiries.status', $inq->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm border-warm" onchange="this.form.submit()">
                              <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>New</option>
                              <option value="read" {{ $inq->status === 'read' ? 'selected' : '' }}>Read</option>
                              <option value="replied" {{ $inq->status === 'replied' ? 'selected' : '' }}>Replied</option>
                            </select>
                          </form>
                          <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">No messages received yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- 4. USERS & COLLECTORS PANE -->
        <div class="tab-pane fade" id="usersPane" role="tabpanel">
          <div class="card border-warm shadow-subtle p-0 overflow-hidden bg-card">
            <div class="p-3 bg-warm-secondary border-bottom border-warm">
              <h5 class="font-serif mb-0">Registered Patrons & Collectors</h5>
            </div>
            <div class="table-responsive">
              <table class="table-admin mb-0">
                <thead>
                  <tr>
                    <th>Collector</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($users as $user)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center gap-2">
                          <div class="admin-user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                          </div>
                          <div>
                            <div class="fw-semibold text-ink">{{ $user->name }}</div>
                            <div class="x-small text-muted">ID: #{{ $user->id }}</div>
                          </div>
                        </div>
                      </td>
                      <td class="small">{{ $user->email }}</td>
                      <td class="small text-muted">{{ $user->phone ?? 'Not provided' }}</td>
                      <td>
                        <span class="badge {{ $user->role === 'Admin' ? 'bg-gold text-white' : 'bg-warm-secondary text-ink border border-warm' }}">
                          {{ $user->role ?? 'Collector' }}
                        </span>
                      </td>
                      <td>
                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                          {{ $user->status ?? 'Active' }}
                        </span>
                      </td>
                      <td class="small text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center py-4 text-muted">No users registered yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

    </div>
  </main>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-warm">
        <div class="modal-header border-warm">
          <h5 class="modal-title font-serif">Add New Handcrafted Creation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.products.store') }}" method="POST">
          @csrf
          <div class="modal-body p-4">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label small fw-semibold">Piece Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Forged Brass Moon Ring" required>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-semibold">Category <span class="text-danger">*</span></label>
                <select name="category" class="form-select" required>
                  <option value="rings">Artisanal Rings</option>
                  <option value="bangles">Hand Bangles & Cuffs</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-semibold">Noble Metal <span class="text-danger">*</span></label>
                <input type="text" name="metal" class="form-control" placeholder="e.g. 18K Gold Vermeil" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-semibold">Metal Filter Key <span class="text-danger">*</span></label>
                <select name="metal_key" class="form-select" required>
                  <option value="gold">18K Gold Vermeil</option>
                  <option value="silver">925 Sterling Silver</option>
                  <option value="brass">Raw Jewelers Brass</option>
                  <option value="rosegold">Rose Gold</option>
                  <option value="oxidized">Oxidized Silver</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-semibold">Price (₹) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="2499" required>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-semibold">Original Price (₹)</label>
                <input type="number" step="0.01" name="original_price" class="form-control" placeholder="3200">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                <input type="number" name="in_stock" class="form-control" value="5" required>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-semibold">Badge (e.g. Bestseller, Limited)</label>
                <input type="text" name="badge" class="form-control" placeholder="Bestseller">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-semibold">Image Asset Path</label>
                <input type="text" name="image" class="form-control" value="assets/images/prod-solitaire-ring.jpg">
              </div>
              <div class="col-12">
                <label class="form-label small fw-semibold">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="3" placeholder="Describe the forged texture, stone, or craft details..." required></textarea>
              </div>
              <div class="col-12">
                <label class="form-label small fw-semibold">Artisan Bench Notes</label>
                <textarea name="artisan_notes" class="form-control" rows="2" placeholder="Cold-forged over 4 hours on steel mandrel..."></textarea>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input type="checkbox" name="is_featured" class="form-check-input" value="1" id="isFeaturedCheck" checked>
                  <label class="form-check-label small" for="isFeaturedCheck">Display on Homepage Featured Strip</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer border-warm">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-gold">Add Piece to Catalog</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
