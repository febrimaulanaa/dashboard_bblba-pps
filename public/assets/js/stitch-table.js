class StitchTable {
    constructor(tableElement) {
        this.table = tableElement;
        this.tbody = this.table.querySelector('tbody');
        if (!this.tbody) return;
        
        this.rows = Array.from(this.tbody.querySelectorAll('tr'));
        this.filteredRows = this.rows;
        
        this.currentPage = 1;
        this.rowsPerPage = 10;
        this.searchQuery = '';
        
        this.initDOM();
        this.render();
    }

    initDOM() {
        // Bersihkan class Bootstrap yang lama
        this.table.classList.remove('table-striped', 'table-bordered', 'table-hover', 'display', 'dataTable', 'table');
        this.table.style.width = '100%';
        this.table.style.borderCollapse = 'collapse';
        
        // Buat Wrapper Utama
        this.wrapper = document.createElement('div');
        this.wrapper.className = 'stitch-table-wrapper w-full';
        this.table.parentNode.insertBefore(this.wrapper, this.table);
        
        // --- TOP BAR ---
        this.topBar = document.createElement('div');
        this.topBar.className = 'flex flex-col md:flex-row justify-between items-center gap-4 mb-6';
        
        // Search
        const searchContainer = document.createElement('div');
        searchContainer.className = 'relative w-full md:w-80';
        searchContainer.innerHTML = `
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 text-[#6f7881]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" placeholder="Search records..." class="w-full pl-10 pr-4 py-2.5 border border-outline-variant/40 rounded-xl text-sm focus:outline-none focus:border-[#006191] focus:ring-1 focus:ring-[#006191] text-[#181c20] transition-all bg-white shadow-sm">
        `;
        const searchInput = searchContainer.querySelector('input');
        searchInput.addEventListener('input', (e) => {
            this.searchQuery = e.target.value.toLowerCase();
            this.currentPage = 1;
            this.filterRows();
        });
        
        // Length Selector
        const lengthContainer = document.createElement('div');
        lengthContainer.className = 'flex items-center gap-2 text-sm text-[#6f7881] font-semibold';
        lengthContainer.innerHTML = `
            Show 
            <select class="border border-outline-variant/40 rounded-lg px-2 py-1 focus:outline-none focus:border-[#006191] text-[#181c20] bg-white shadow-sm cursor-pointer">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            entries
        `;
        const lengthSelect = lengthContainer.querySelector('select');
        lengthSelect.addEventListener('change', (e) => {
            this.rowsPerPage = parseInt(e.target.value);
            this.currentPage = 1;
            this.render();
        });

        const leftControls = document.createElement('div');
        leftControls.className = 'flex items-center gap-4 w-full md:w-auto';
        leftControls.appendChild(searchContainer);
        leftControls.appendChild(lengthContainer);

        this.topBar.appendChild(leftControls);
        
        // --- TABLE CONTAINER ---
        const tableResponsive = document.createElement('div');
        tableResponsive.className = 'overflow-x-auto w-full';
        tableResponsive.appendChild(this.table);

        // --- BOTTOM BAR ---
        this.bottomBar = document.createElement('div');
        this.bottomBar.className = 'flex flex-col md:flex-row justify-between items-center gap-4 mt-6';
        
        this.infoText = document.createElement('div');
        this.infoText.className = 'text-sm text-[#6f7881] font-bold';
        
        this.paginationContainer = document.createElement('div');
        this.paginationContainer.className = 'flex gap-1.5 flex-wrap';

        this.bottomBar.appendChild(this.infoText);
        this.bottomBar.appendChild(this.paginationContainer);

        // Gabungkan semuanya
        this.wrapper.appendChild(this.topBar);
        this.wrapper.appendChild(tableResponsive);
        this.wrapper.appendChild(this.bottomBar);
    }

    filterRows() {
        if (this.searchQuery.trim() === '') {
            this.filteredRows = this.rows;
        } else {
            this.filteredRows = this.rows.filter(row => {
                return row.textContent.toLowerCase().includes(this.searchQuery);
            });
        }
        this.render();
    }

    render() {
        // Kosongkan tbody
        this.tbody.innerHTML = '';
        
        const totalRows = this.filteredRows.length;
        const totalPages = Math.ceil(totalRows / this.rowsPerPage);
        
        if (this.currentPage > totalPages) this.currentPage = Math.max(1, totalPages);
        
        const start = (this.currentPage - 1) * this.rowsPerPage;
        const end = Math.min(start + this.rowsPerPage, totalRows);
        
        // Tambahkan baris yang sesuai halaman
        for (let i = start; i < end; i++) {
            this.tbody.appendChild(this.filteredRows[i]);
        }
        
        // Update text informasi
        if(totalRows === 0) {
            this.infoText.textContent = `Showing 0 to 0 of 0 entries`;
        } else {
            this.infoText.textContent = `Showing ${start + 1} to ${end} of ${totalRows} entries`;
        }
        
        this.renderPagination(totalPages);
    }

    renderPagination(totalPages) {
        this.paginationContainer.innerHTML = '';
        if (totalPages <= 1) return;

        const createButton = (text, page, isActive = false, isDisabled = false) => {
            const btn = document.createElement('button');
            btn.innerHTML = text;
            btn.className = `px-3 py-1.5 text-sm font-bold rounded-lg border transition-all ${
                isActive 
                ? 'bg-[#006191] text-white border-[#006191] shadow-md' 
                : isDisabled
                ? 'bg-gray-50 text-gray-400 border-outline-variant/20 cursor-not-allowed opacity-60'
                : 'bg-white text-[#181c20] border-outline-variant/40 hover:bg-gray-50 cursor-pointer'
            }`;
            
            if (!isDisabled && !isActive) {
                btn.addEventListener('click', () => {
                    this.currentPage = page;
                    this.render();
                });
            }
            return btn;
        };

        // Previous
        this.paginationContainer.appendChild(createButton('Previous', this.currentPage - 1, false, this.currentPage === 1));
        
        // Logika ellipsis
        let startPage = Math.max(1, this.currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }

        if (startPage > 1) {
            this.paginationContainer.appendChild(createButton('1', 1));
            if (startPage > 2) {
                const dots = document.createElement('span');
                dots.className = 'px-2 py-1.5 text-[#6f7881]';
                dots.textContent = '...';
                this.paginationContainer.appendChild(dots);
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            this.paginationContainer.appendChild(createButton(i, i, i === this.currentPage));
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const dots = document.createElement('span');
                dots.className = 'px-2 py-1.5 text-[#6f7881]';
                dots.textContent = '...';
                this.paginationContainer.appendChild(dots);
            }
            this.paginationContainer.appendChild(createButton(totalPages, totalPages));
        }

        // Next
        this.paginationContainer.appendChild(createButton('Next', this.currentPage + 1, false, this.currentPage === totalPages));
    }
    
    // Auto-init untuk semua tabel
    static initAll() {
        const tables = document.querySelectorAll('table#example, table#basic-datatables, table.stitch-table');
        tables.forEach(t => {
            if(!t.dataset.stitchInit) {
                new StitchTable(t);
                t.dataset.stitchInit = "true";
            }
        });
    }
}

// Inisialisasi setelah DOM siap
document.addEventListener('DOMContentLoaded', () => {
    StitchTable.initAll();
});
