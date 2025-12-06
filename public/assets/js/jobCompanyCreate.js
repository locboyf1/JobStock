document.addEventListener("DOMContentLoaded", function () {
    const oldContent = window.jobContentData || [];

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
            <div class="section-block" id="section-${sectionIndex}" style="margin-bottom: 20px; border: 1px solid #e0e0e0; padding: 15px; border-radius: 4px;">
                <div class="row">
                    <div class="col-md-11 col-sm-11">
                        <h4 style="margin-top: 0;">Khối nội dung #${sectionIndex + 1}</h4>
                    </div>
                    <div class="col-md-1 col-sm-1 text-right">
                        <button type="button" class="btn btn-danger btn-sm btn-remove-section" data-id="${sectionIndex}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" name="content[${sectionIndex}][title]" 
                                   value="${titleValue}" placeholder="Tiêu đề (VD: Yêu cầu công việc)">
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12" style="margin-top: 10px;">
                        <textarea name="content[${sectionIndex}][description]" class="form-control" rows="3" 
                                  placeholder="Mô tả (tùy chọn)">${descValue}</textarea>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <label>Các dòng nội dung (Danh sách):</label>
                        <div id="rows-${sectionIndex}"></div>
                        
                        <div style="margin-top: 10px;">
                            <button type="button" class="btn btn-primary btn-sm btn-add-row" data-idx="${sectionIndex}">
                                <i class="fa fa-plus"></i> Thêm dòng
                            </button>
                        </div>
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
            <div class="row line-item" style="margin-top: 5px;">
                <div class="col-md-11 col-sm-11">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                        <input type="text" class="form-control" name="content[${idx}][row_content][]" 
                               value="${safeValue}" placeholder="Dòng nội dung...">
                    </div>
                </div>
                <div class="col-md-1 col-sm-1">
                    <button class="btn btn-danger btn-remove-row" type="button"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        $(`#rows-${idx}`).append(rowHtml);
    }

    $('#btn-add-section').click(function (e) {
        e.preventDefault();
        addSection();
    });

    $(document).on('click', '.btn-add-row', function (e) {
        e.preventDefault();
        let idx = $(this).data('idx');
        addRow(idx);
    });

    $(document).on('click', '.btn-remove-section', function () {
        let idx = $(this).data('id');
        $(`#section-${idx}`).remove();
    });

    $(document).on('click', '.btn-remove-row', function () {
        $(this).closest('.line-item').remove();
    });

    initOldData();
});
