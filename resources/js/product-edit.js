// Toast
function showToast(message, type = 'error') {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `${type === 'success' ? 'bg-green-600' : 'bg-(--secondary-color)'} text-white px-5 py-4 rounded-xl shadow-lg`;
    toast.textContent = message;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}

// Specifications
let specIndex = 0;
function addSpecification() {
    const container = document.getElementById('specifications');
    const row = document.createElement('div');
    row.className = 'flex gap-3 items-end';
    row.innerHTML = `
        <input type="text" name="specifications[${specIndex}][key]" placeholder="Key (e.g. Material)"
            class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl">
        <input type="text" name="specifications[${specIndex}][value]" placeholder="Value (e.g. 100% Wool)"
            class="flex-1 px-4 py-3 bg-(--card-dark) border border-(--bg-color)/30 rounded-xl">
        <button type="button" onclick="this.parentElement.remove()"
            class="text-red-500 hover:text-red-600 p-2">
            <i data-lucide="trash-2"></i>
        </button>
    `;
    container.appendChild(row);
    specIndex++;
    lucide.createIcons();
}

// Single Image Upload
let uploadedFile = null;
const uploadArea = document.getElementById('uploadArea');
const mediaInput = document.getElementById('mediaInput');
const previewGrid = document.getElementById('previewGrid');

uploadArea.addEventListener('click', () => mediaInput.click());
mediaInput.addEventListener('change', e => handleFile(e.target.files[0]));

uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.style.borderColor = 'var(--secondary-color)'; });
uploadArea.addEventListener('dragleave', () => uploadArea.style.borderColor = '');
uploadArea.addEventListener('drop', e => {
    e.preventDefault();
    uploadArea.style.borderColor = '';
    handleFile(e.dataTransfer.files[0]);
});

function handleFile(file) {
    if (!file) return;
    if (!file.type.startsWith('image/')) return showToast("Only images allowed");
    if (file.size > 100 * 1024) return showToast("Max 100KB allowed");

    uploadedFile = file;
    renderPreview(file);
    syncFileInput();
}

function renderPreview(file) {
    const reader = new FileReader();
    reader.onload = e => {
        previewGrid.innerHTML = `
            <div class="aspect-square border rounded-2xl overflow-hidden relative group">
                <img src="${e.target.result}" class="w-full h-full object-cover">
                <button onclick="removeImage()" class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full">✕</button>
            </div>
        `;
    };
    reader.readAsDataURL(file);
}

function removeImage() {
    uploadedFile = null;
    previewGrid.innerHTML = '';
    mediaInput.value = '';
}

function syncFileInput() {
    const dt = new DataTransfer();
    if (uploadedFile) dt.items.add(uploadedFile);
    mediaInput.files = dt.files;
}

// Description Counter
const desc = document.querySelector('textarea[name="description"]');
const charCount = document.getElementById('charCount');
if (desc) {
    desc.addEventListener('input', () => charCount.textContent = `${desc.value.length}/2000`);
}

// ==================== LIVE DISCOUNT CALCULATION ====================
function updateDiscountPreview() {
    const basePriceInput = document.getElementById('base_price');
    const discountInput = document.getElementById('discount_amount');
    const previewEl = document.getElementById('pricePreview');

    if (!basePriceInput || !discountInput || !previewEl) return;

    const basePrice = parseFloat(basePriceInput.value) || 0;
    const discountPercent = parseFloat(discountInput.value) || 0;

    if (basePrice > 0 && discountPercent > 0) {
        if (discountPercent > 99 || discountPercent < 0) {
            previewEl.innerHTML = '<span class="text-red-500">Discount percentage must be between 0 and 99.</span>';
        } else {
            const sellingPrice = basePrice - (basePrice * discountPercent / 100);
            previewEl.innerHTML = `<span class="font-semibold text-green-600">Final Price: Rs.${sellingPrice.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span> <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full ml-1">${discountPercent}% off</span>`;
        }
    } else {
        previewEl.innerHTML = '<span class="text-gray-400">No discount applied</span>';
    }
}


// ==================== FORM SUBMISSION ====================
document.getElementById('productForm').addEventListener('submit', function (e) {
    if (!validateForm()) {
        e.preventDefault();
        showToast("Please upload one product image");
    }
});

// Init
document.addEventListener('DOMContentLoaded', () => {
    addSpecification();
    lucide.createIcons();
});

window.addSpecification = addSpecification;
window.removeImage = removeImage;
