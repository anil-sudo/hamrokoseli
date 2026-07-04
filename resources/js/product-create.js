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

// ==================== VALIDATE FORM ====================
function validateForm() {
    let isValid = true;

    // Common fields
    const name = document.getElementById('product_name');
    if (!name.value.trim()) { showError(name, "Product name is required"); isValid = false; } else clearError(name);

    const category = document.getElementById('category');
    if (!category.value) { showError(category, "Please select a category"); isValid = false; } else clearError(category);

    const desc = document.getElementById('description');
    if (!desc.value.trim()) { showError(desc, "Description is required"); isValid = false; } else clearError(desc);

    if (uploadedFiles.length === 0) {
        showToast("Please upload at least one image.");
        isValid = false;
    }

    if (variantsEnabled) {
        const variantRows = document.querySelectorAll('.variant-row');
        if (variantRows.length === 0) {
            showToast("Please add at least one variant.", 'error');
            isValid = false;
        }
    } else {
        // Normal product validation
        const basePrice = document.getElementById('base_price');
        if (!basePrice.value || parseFloat(basePrice.value) <= 0) {
            showError(basePrice, "Base price must be greater than 0");
            isValid = false;
        } else clearError(basePrice);

        const stock = document.getElementById('stock');
        if (!stock.value || parseInt(stock.value) < 0) {
            showError(stock, "Stock quantity cannot be negative");
            isValid = false;
        } else clearError(stock);

        const discountedPrice = document.getElementById('discounted_price');
        if (discountedPrice && discountedPrice.value && discountedPrice.value !== '0') {
            const discVal = parseFloat(discountedPrice.value);
            const baseVal = parseFloat(basePrice.value || 0);
            if (discVal < 0) {
                showError(discountedPrice, "Discount cannot be negative");
                isValid = false;
            } else if (discVal >= baseVal) {
                showError(discountedPrice, "Discount must be less than the base price");
                isValid = false;
            } else {
                clearError(discountedPrice);
            }
        }
    }

    return isValid;
}


// ==================== SPECIFICATIONS ====================
let specIndex = 0;
function addSpecification() {
    const container = document.getElementById('specifications');
    const row = document.createElement('div');
    row.className = 'border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50';
    row.innerHTML = `
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
            <div class="sm:col-span-5 col-span-12">
                <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Specification Name</label>
                <input type="text" name="specifications[${specIndex}][key]" placeholder="e.g. Material, Weight"
                    class="w-full px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-base focus:outline-none focus:border-(--secondary-color)">
            </div>
            <div class="sm:col-span-6 col-span-12">
                <label class="block text-xs font-medium text-(--text-color)/70 mb-1">Value</label>
                <input type="text" name="specifications[${specIndex}][value]" placeholder="e.g. Himalayan Wool, 500g"
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
    specIndex++;
    lucide.createIcons();
}

// ==================== VARIANT TOGGLE ====================
let variantsEnabled = false;

function toggleVariants() {
    variantsEnabled = !variantsEnabled;
    const toggleBtn = document.getElementById('variantToggleBtn');
    const variantsSection = document.getElementById('variantsSection');
    const pricingSection = document.getElementById('pricingSection');

    // Pricing fields that should be required only when variants are OFF
    const basePrice = document.getElementById('base_price');
    const sku = document.getElementById('sku');
    const stock = document.getElementById('stock');

    if (variantsEnabled) {
        toggleBtn.classList.add('bg-(--secondary-color)', 'text-white', 'hover:bg-[#B94E31]');
        toggleBtn.classList.remove('border-(--secondary-color)', 'text-(--secondary-color)');
        toggleBtn.innerHTML = `<i data-lucide="toggle-right" class="w-5 h-5"></i> Variants Enabled`;

        variantsSection.classList.remove('hidden');
        pricingSection.classList.add('hidden');

        // Disable & remove required from pricing fields so browser won't block submit
        basePrice.required = false;
        basePrice.disabled = true;
        sku.required = false;
        sku.disabled = true;
        stock.required = false;
        stock.disabled = true;

        if (document.getElementById('variants').children.length === 0) {
            addVariant();
        }
    } else {
        toggleBtn.classList.remove('bg-(--secondary-color)', 'text-white', 'hover:bg-[#B94E31]');
        toggleBtn.classList.add('border-(--secondary-color)', 'text-(--secondary-color)');
        toggleBtn.innerHTML = `<i data-lucide="toggle-left" class="w-5 h-5"></i> Add Variants`;

        variantsSection.classList.add('hidden');
        pricingSection.classList.remove('hidden');

        // Re-enable & restore required on pricing fields
        basePrice.required = true;
        basePrice.disabled = false;
        sku.required = true;
        sku.disabled = false;
        stock.required = true;
        stock.disabled = false;

        // IMPORTANT: Clear all variants when disabling to prevent validation error
        document.getElementById('variants').innerHTML = '';
    }
    lucide.createIcons();
}

// ==================== VARIANTS ====================
let variantIndex = 0;
function addVariant() {
    const container = document.getElementById('variants');
    const row = document.createElement('div');
    row.className = 'variant-row border border-(--text-color)/20 rounded-2xl p-5 bg-(--card-dark)/50';
    row.innerHTML = `
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-3">
            <input type="text" name="variants[${variantIndex}][sku]" placeholder="SKU *" required
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
            <input type="text" name="variants[${variantIndex}][size]" placeholder="Size (e.g. M, L, XL)"
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
            <input type="text" name="variants[${variantIndex}][color]" placeholder="Color"
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
            <input type="number" name="variants[${variantIndex}][price]" placeholder="Price" min="0" step="1"
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
            <input type="number" name="variants[${variantIndex}][discounted_price]" placeholder="Discount (Rs.)" min="0" step="1"
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
            <input type="number" name="variants[${variantIndex}][stock]" placeholder="Stock" min="0" value="0"
                class="px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl text-sm focus:outline-none focus:border-(--secondary-color)">
        </div>
        <button type="button" onclick="this.closest('.variant-row').remove()"
            class="text-sm text-red-400 hover:text-red-600 flex items-center gap-1">
            <i data-lucide="trash-2" class="w-4 h-4"></i> Remove variant
        </button>
    `;
    container.appendChild(row);
    variantIndex++;
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

function syncFileInput() {
    // Rebuild the real <input type="file"> FileList from our tracked
    // uploadedFiles array, since browsers won't let us assign an array
    // directly to input.files. Without this, the form submits with no
    // files attached and nothing gets saved to the database.
    const dataTransfer = new DataTransfer();
    uploadedFiles.forEach(file => dataTransfer.items.add(file));
    mediaInput.files = dataTransfer.files;
}

function handleFiles(files) {
    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) {
            showToast("Only image files are allowed.", 'error'); return;
        }

        if (file.size > 100 * 1024) {
            showToast(`"${file.name}" is too large. Maximum size is 100KB.`, 'error');
            return;
        }

        if (uploadedFiles.length >= 4) {
            showToast("Maximum 4 images allowed.", 'error'); return;
        }
        const exists = uploadedFiles.some(
            f => f.name === file.name &&
                f.size === file.size
        );

        if (exists) {
            showToast("This image is already added.");
            return;
        }
        uploadedFiles.push(file);
        renderImagePreview(file);
    });
    syncFileInput();
}

function renderImagePreview(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
        const div = document.createElement('div');
        div.className =
            'aspect-square border border-(--text-color)/20 rounded-2xl overflow-hidden relative group';
        div.innerHTML = `
            <img src="${e.target.result}" class="w-full h-full object-cover">
            <button onclick="removeImage(this)"
                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-all">
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

// ==================== DESCRIPTION COUNTER ====================
const descriptionEl = document.getElementById('description');
const charCountEl = document.getElementById('charCount');

function updateCharCount() {
    charCountEl.textContent = descriptionEl.value.length + '/2000';
}
descriptionEl.addEventListener('input', updateCharCount);
updateCharCount(); // run on load (for old() repopulation)


// ==================== FORM SUBMISSION ====================
document.getElementById('productForm').addEventListener('submit', function (e) {
    if (!validateForm()) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});

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

// ==================== INITIAL LOAD ====================
document.addEventListener('DOMContentLoaded', () => {
    const specs = document.getElementById('specifications');
    if (specs.children.length === 0) {
        addSpecification();
    }

    // If old variants data exists, enable variants mode
    // variantsEnabled starts false, so calling toggleVariants() will flip it to true
    if (document.getElementById('variants').children.length > 0) {
        variantsEnabled = false; // ensure it starts false so toggle flips to true
        toggleVariants();
    }

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
window.toggleVariants = toggleVariants;
window.updateDiscountPreview = updateDiscountPreview;
