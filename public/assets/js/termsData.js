document.addEventListener("DOMContentLoaded", function () {
    const oldContent = window.companyContentData || [];

    let sectionIndex = 0;

    function escapeHtml(text) {
        if (!text) return "";
        return String(text).replace(/"/g, "&quot;");
    }

    function initOldData() {

        if (Array.isArray(oldContent) && oldContent.length > 0) {
            oldContent.forEach(function (sectionData) {

                addSection(sectionData);
            });
        } else {
            addSection();
        }
    }

    function addSection(data = null) {

        let titleValue = (data && data.title) ? data.title : '';
        let descValue = (data && data.description) ? data.description : '';

        let html = `
                <div class="panel panel-info section-block" id="section-${sectionIndex}">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-10">
                                <h3 class="panel-title"><i class="fa fa-cube"></i> Khối nội dung #${sectionIndex + 1}</h3>
                            </div>
                            <div class="col-xs-2 text-right">
                                <button type="button" class="btn btn-danger btn-xs btn-remove-section" data-id="${sectionIndex}">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tiêu đề khối:</label>
                            <input type="text" class="form-control" name="content[${sectionIndex}][title]" 
                                   value="${titleValue}" placeholder="VD: Tầm nhìn, Sứ mệnh..." required>
                        </div>
                        
                        <div class="form-group">
                            <label>Mô tả ngắn:</label>
                            <textarea class="form-control" name="content[${sectionIndex}][description]" 
                                      rows="2" placeholder="Mô tả tổng quan...">${descValue}</textarea>
                        </div>

                        <label>Các dòng nội dung (Bullet points):</label>
                        <div class="row-container" id="rows-${sectionIndex}">
                        </div>

                        <div style="margin-top: 10px;">
                            <button type="button" class="btn btn-default btn-xs btn-add-row" data-idx="${sectionIndex}">
                                <i class="fa fa-plus"></i> Thêm dòng
                            </button>
                        </div>
                    </div>
                </div>
            `;

        $('#content-list').append(html);

        if (data && data.row_content && Array.isArray(data.row_content)) {
            data.row_content.forEach(function (rowValue) {
                addRow(sectionIndex, rowValue);
            });
        } else {
            addRow(sectionIndex);
        }

        sectionIndex++;
    }

    function addRow(idx, value = '') {
        let safeValue = escapeHtml(value || '');
        let rowHtml = `
                <div class="input-group" style="margin-bottom: 5px;">
                    <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                    <input type="text" class="form-control" name="content[${idx}][row_content][]" 
                           value="${safeValue}" placeholder="Nội dung chi tiết...">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-remove-row" type="button"><i class="fa fa-times text-danger"></i></button>
                    </span>
                </div>
            `;
        $(`#rows-${idx}`).append(rowHtml);
    }
    $('#btn-add-section').click(function () {
        addSection();
    });

    $(document).on('click', '.btn-add-row', function () {
        let idx = $(this).data('idx');
        addRow(idx);
    });

    $(document).on('click', '.btn-remove-section', function () {
        let idx = $(this).data('id');
        $(`#section-${idx}`).remove();
    });

    $(document).on('click', '.btn-remove-row', function () {
        $(this).closest('.input-group').remove();
    });

    initOldData();
});