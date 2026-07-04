// ==================== VALIDATION ====================
function showError(input, message) {
    const errorEl = input.parentElement.querySelector('.error');
    if (errorEl) {
        errorEl.textContent = message;
        errorEl.classList.remove('hidden');
    }
    input.classList.add('border-red-500');
}

function clearError(input) {
    const errorEl = input.parentElement.querySelector('.error');
    if (errorEl) errorEl.classList.add('hidden');
    input.classList.remove('border-red-500');
}

function showToast(message, type = 'error') {
    const container = document.getElementById('toastContainer');

    const toast = document.createElement('div');

    const bgColor = type === 'success'
        ? 'bg-(--primary-color)'
        : 'bg-(--secondary-color)';

    toast.className =
        `${bgColor} text-white px-5 py-4 rounded-xl shadow-lg flex items-center gap-3 min-w-[300px] animate-toast`;

    toast.innerHTML = `
        <span>${message}</span>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 4000);
}

function validateForm() {
    let isValid = true;

    // Product Name
    const name = document.getElementById('product_name');
    if (!name.value.trim()) {
        showError(name, "Product name is required");
        isValid = false;
    } else clearError(name);

    // Category
    const category = document.getElementById('category');
    if (!category.value) {
        showError(category, "Please select a category");
        isValid = false;
    } else clearError(category);

    // Description
    const desc = document.getElementById('description');
    if (!desc.value.trim()) {
        showError(desc, "Description is required");
        isValid = false;
    } else clearError(desc);

    // Base Price
    const basePrice = document.getElementById('base_price');
    if (!basePrice.value || parseFloat(basePrice.value) <= 0) {
        showError(basePrice, "Base price must be greater than 0");
        isValid = false;
    } else clearError(basePrice);

    // Discount Amount
    const discPrice = document.getElementById('discounted_price');
    if (discPrice && discPrice.value && discPrice.value !== '0') {
        const discVal = parseFloat(discPrice.value);
        const baseVal = parseFloat(basePrice.value || 0);
        if (discVal < 0) {
            showError(discPrice, "Discount cannot be negative");
            isValid = false;
        } else if (discVal >= baseVal) {
            showError(discPrice, "Discount must be less than the base price");
            isValid = false;
        } else {
            clearError(discPrice);
        }
    } else {
        clearError(discPrice);
    }

    // SKU
    const sku = document.getElementById('sku');
    if (!sku.value.trim()) {
        showError(sku, "SKU is required");
        isValid = false;
    } else clearError(sku);

    // Stock
    const stock = document.getElementById('stock');
    if (!stock.value || parseInt(stock.value) < 0) {
        showError(stock, "Stock quantity cannot be negative");
        isValid = false;
    } else clearError(stock);

    // At least one specification
    const specs = document.querySelectorAll('#specifications .grid');
    if (specs.length === 0) {
        showToast("Please add at least one specification.");
        isValid = false;
    }

    // At least one variant
    const variants = document.querySelectorAll('#variants .border');
    if (variants.length === 0) {
        showToast("Please add at least one variant.");
        isValid = false;
    }

    return isValid;
}

// ==================== SPECIFICATIONS ====================
function addSpecification() {
    const container = document.getElementById('specifications');
    const row = document.createElement('div');
    row.className = 'border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50';
    row.innerHTML = `
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
            <div class="sm:col-span-5 col-span-12">
                <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Specification Name</label>
                <input type="text" name="spec_name" placeholder="e.g. Material, Weight"
                    class="w-full px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
            </div>
            <div class="sm:col-span-6 col-span-12">
                <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Value</label>
                <input type="text" name="spec_value" placeholder="e.g. Himalayan Wool, 500g"
                    class="w-full px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
            </div>
            <div class="sm:col-span-1 col-span-12 flex sm:items-end">
                <button type="button" onclick="this.closest('.border').remove()"
                    class="w-full sm:w-11 h-11 flex items-center justify-center text-(--secondary-color) hover:text-red-500 rounded-2xl transition">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
       `;
    container.appendChild(row);
    lucide.createIcons();
}

// ==================== VARIANTS ====================
function addVariant() {
    const container = document.getElementById('variants');
    const row = document.createElement('div');
    row.className = 'border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50';
    row.innerHTML = `
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-5">
                        <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Variant Name</label>
                        <input type="text"  placeholder="e.g. Size, Color"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                    </div>
                    <div class="col-span-6">
                        <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Values</label>
                        <input type="text" placeholder="e.g. S, M, L"
                            class="w-full px-5 py-4 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base">
                    </div>
                    <div class="col-span-1 flex items-end">
                        <button type="button" onclick="this.closest('.border').remove()" class="w-11 h-11 flex items-center justify-center text-(--secondary-color) hover:text-red-500 rounded-2xl transition">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            `;
    container.appendChild(row);
    lucide.createIcons();
}

// ==================== IMAGE UPLOAD ====================
let uploadedFiles = [];

const uploadArea = document.getElementById('uploadArea');
const mediaInput = document.getElementById('mediaInput');
const previewGrid = document.getElementById('previewGrid');

uploadArea.addEventListener('click', () => mediaInput.click());
mediaInput.addEventListener('change', (e) => handleFiles(e.target.files));

// Drag & Drop
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = 'var(--secondary-color)';
});
uploadArea.addEventListener('dragleave', () => {
    uploadArea.style.borderColor = '';
});
uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '';
    handleFiles(e.dataTransfer.files);
});

function handleFiles(files) {
    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return alert("Only image files allowed.");
        if (file.size > 10 * 1024 * 1024) return alert("File too large. Max 10MB.");
        if (uploadedFiles.length + previewGrid.children.length >= 4) return alert(
            "Maximum 4 images allowed.");

        uploadedFiles.push(file);
        renderImagePreview(file);
    });

    syncFileInput();
}

function syncFileInput() {
    const dataTransfer = new DataTransfer();
    uploadedFiles.forEach(file => dataTransfer.items.add(file));
    mediaInput.files = dataTransfer.files;
}

function renderImagePreview(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        const div = document.createElement('div');
        div.className =
            'aspect-square border border-(--text-color)/20 rounded-2xl overflow-hidden relative group';
        div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <button onclick="removeImage(this)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-all">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                `;
        previewGrid.appendChild(div);
        lucide.createIcons();
    };
    reader.readAsDataURL(file);
}

function removeImage(btn) {
    const index = Array.from(previewGrid.children).indexOf(btn.parentElement);
    uploadedFiles.splice(index, 1);
    btn.parentElement.remove();
    syncFileInput();
}


// ==================== LIVE DISCOUNT CALCULATION ====================
function updateDiscountPreview() {
    const basePriceInput = document.getElementById('base_price');
    const discountedPriceInput = document.getElementById('discounted_price');
    const discountPreviewEl = document.getElementById('discount_preview');

    if (!basePriceInput || !discountedPriceInput || !discountPreviewEl) return;

    const basePrice = parseFloat(basePriceInput.value) || 0;
    const discountAmount = parseFloat(discountedPriceInput.value) || 0;

    if (basePrice > 0 && discountAmount > 0) {
        if (discountAmount >= basePrice) {
            discountPreviewEl.textContent = "Discount must be less than the base price.";
            discountPreviewEl.className = "text-xs text-red-500 font-medium mt-1.5";
            discountPreviewEl.classList.remove('hidden');
        } else {
            const sellingPrice = basePrice - discountAmount;
            const percentage = Math.round((discountAmount / basePrice) * 100);
            discountPreviewEl.textContent = `Selling Price: Rs. ${sellingPrice.toLocaleString()} (${percentage}% off)`;
            discountPreviewEl.className = "text-xs text-green-600 font-medium mt-1.5";
            discountPreviewEl.classList.remove('hidden');
        }
    } else {
        discountPreviewEl.classList.add('hidden');
    }
}

// Form Submit
document.getElementById('productForm').addEventListener('submit', function (e) {
    if (!validateForm()) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Live Discount Calculation listeners
    const basePriceInput = document.getElementById('base_price');
    const discountedPriceInput = document.getElementById('discounted_price');
    if (basePriceInput && discountedPriceInput) {
        basePriceInput.addEventListener('input', updateDiscountPreview);
        discountedPriceInput.addEventListener('input', updateDiscountPreview);
        updateDiscountPreview();
    }
});

window.addSpecification = addSpecification;
window.addVariant = addVariant;
window.removeImage = removeImage;
window.updateDiscountPreview = updateDiscountPreview;
