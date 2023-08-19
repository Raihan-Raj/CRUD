(function($, window, document, undefined) {
    var pluginName = "editable",
        defaults = {
            keyboard: true,
            dblclick: true,
            button: true,
            buttonSelector: ".edit",
            maintainWidth: true,
            dropdowns: {},
            edit: function() {},
            save: function() {},
            cancel: function() {}
        };

    function editable(element, options) {
        this.element = element;
        this.options = $.extend({}, defaults, options);

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

    editable.prototype = {
        init: function() {
            this.editing = false;

            if (this.options.dblclick) {
                $(this.element)
                    .css('cursor', 'pointer')
                    .bind('dblclick', this.toggle.bind(this));
            }

            if (this.options.button) {
                $(this.options.buttonSelector, this.element)
                    .bind('click', this.toggle.bind(this));
            }
        },

        toggle: function(e) {
            e.preventDefault();

            this.editing = !this.editing;

            if (this.editing) {
                this.edit();
            } else {
                this.save();
            }
        },

        edit: function() {
            var instance = this,
                values = {};

            $('td[data-field]', this.element).each(function() {
                var input,
                    field = $(this).data('field'),
                    value = $(this).text(),
                    width = $(this).width();

                values[field] = value;

                $(this).empty();

                if (instance.options.maintainWidth) {
                    $(this).width(width);
                }

                if (field in instance.options.dropdowns) {
                    input = $('<select></select>');

                    for (var i = 0; i < instance.options.dropdowns[field].length; i++) {
                        $('<option></option>')
                            .text(instance.options.dropdowns[field][i])
                            .appendTo(input);
                    };

                    input.val(value)
                        .data('old-value', value)
                        .dblclick(instance._captureEvent);
                } else {
                    input = $('<input type="text" />')
                        .val(value)
                        .data('old-value', value)
                        .dblclick(instance._captureEvent);
                }

                input.appendTo(this);

                if (instance.options.keyboard) {
                    input.keydown(instance._captureKey.bind(instance));
                }
            });

            this.options.edit.bind(this.element)(values);
        },

        save: function() {
            var instance = this,
                values = {};

            $('td[data-field]', this.element).each(function() {
                var value = $(':input', this).val();

                values[$(this).data('field')] = value;

                $(this).empty()
                    .text(value);
            });

            this.options.save.bind(this.element)(values);
        },

        cancel: function() {
            var instance = this,
                values = {};

            $('td[data-field]', this.element).each(function() {
                var value = $(':input', this).data('old-value');

                values[$(this).data('field')] = value;

                $(this).empty()
                    .text(value);
            });

            this.options.cancel.bind(this.element)(values);
        },

        _captureEvent: function(e) {
            e.stopPropagation();
        },

        _captureKey: function(e) {
            if (e.which === 13) {
                this.editing = false;
                this.save();
            } else if (e.which === 27) {
                this.editing = false;
                this.cancel();
            }
        }
    };

    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName,
                    new editable(this, options));
            }
        });
    };

})(jQuery, window, document);

editTable();

//custome editable starts
function editTable() {

    $(function() {
        var pickers = {};

        $('table tr').editable({
            dropdowns: {
                Stock: ['available', 'unavailable']
            },
            edit: function(values) {
                $(".edit i", this)
                    .removeClass('fa-pencil')
                    .addClass('fa-save')
                    .attr('title', 'Save');

                pickers[this] = new Pikaday({
                    field: $("td[data-field=birthday] input", this)[0],
                    format: 'MMM D, YYYY'
                });
            },
            save: function(values) {
                $(".edit i", this)
                    .removeClass('fa-save')
                    .addClass('fa-pencil')
                    .attr('title', 'Edit');

                if (this in pickers) {
                    pickers[this].destroy();
                    delete pickers[this];
                }
            },
            cancel: function(values) {
                $(".edit i", this)
                    .removeClass('fa-save')
                    .addClass('fa-pencil')
                    .attr('title', 'Edit');

                if (this in pickers) {
                    pickers[this].destroy();
                    delete pickers[this];
                }
            }
        });
    });

}

$(".add-row").click(function() {
    $("#editableTable").find("tbody tr:first").before("<tr><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td><td data-field='name'></td>  <td data-field='name'></td>  <td data-field='Stock'></td> <td data-field='name'></td> <td data-field='name'></td> <td><a class='button button-small edit' title='Edit'><i class='fa fa-solid fa-pen'></i></a> <a class='button button-small' title='Delete'><i class='fa fa-trash'></i></a></td></tr>");
    editTable();
    setTimeout(function() {
        $("#editableTable").find("tbody tr:first td:last a[title='Edit']").click();
    }, 200);

    setTimeout(function() {
        $("#editableTable").find("tbody tr:first td:first input[type='text']").focus();
    }, 300);

    $("#editableTable").find("a[title='Delete']").unbind('click').click(function(e) {
        $(this).closest("tr").remove();
    });

});

function myFunction() {

}

$("#editableTable").find("a[title='Delete']").click(function(e) {
    var x;
    if (confirm("Are you sure you want to delete entire row?") == true) {
        $(this).closest("tr").remove();
    } else {

    }
});

$(document).on("click", "#cust_btn", function() {

    $("#myModal").modal("toggle");

})

$(function() {
    $(".input-currency-euro")
        .wrap("<span></span>")
        .before("<span><span class=\"input-currency-euro-value\"></span><span class=\"input-currency-euro-symbol\">%</span></span>");

    $(".input-currency-euro")
        .parent()
        .css("position", "relative");

    $(".input-currency-euro-symbol")
        .hide();

    $(".input-currency-euro-value").parent().each(function() {
        var $span = $(this);
        var $input = $span.siblings(".input-currency-euro");

        $span.css({
            position: "absolute",
            overflow: "hidden",
            font: $input.css("font"),
            fontFamily: $input.css("fontFamily"),
            fontSize: $input.css("fontSize"),
            margin: $input.css("margin"),
            padding: $input.css("padding"),
            border: $input.css("border"),
            textAlign: $input.css("textAlign"),
            borderColor: "rgba(0,0,0,0)",
            color: "rgba(0,0,0,0)",
            pointerEvents: "none"

        });

        $span.width($input.width());
        $span.height($input.height());

        $span.position({
            my: "center",
            at: "center",
            of: $input
        });
    });

    $(".input-currency-euro").on("propertychange change click keyup input paste", updateCurrencyValue);

    function updateCurrencyValue(inputEvent) {
        var $input = $(inputEvent.target);
        var value = $input.val();
        var $span = $input.parent();


        $span.width($input.width());
        $span.height($input.height());

        $span.position({
            my: "center",
            at: "center",
            of: $input
        });


        if (value == "") {
            $input.parent().find(".input-currency-euro-symbol").hide();
        } else {
            $input.parent().find(".input-currency-euro-symbol").show();
        }

        $input.parent().find(".input-currency-euro-value").text(value);
    }

});





//I added event handler for the file upload control to access the files properties.
// Select Upload-Area
const uploadArea = document.querySelector('#uploadArea')

// Select Drop-Zoon Area
const dropZoon = document.querySelector('#dropZoon');

// Loading Text
const loadingText = document.querySelector('#loadingText');

// Slect File Input 
const fileInput = document.querySelector('#fileInput');

// Select Preview Image
const previewImage = document.querySelector('#previewImage');

// File-Details Area
const fileDetails = document.querySelector('#fileDetails');

// Uploaded File
const uploadedFile = document.querySelector('#uploadedFile');

// Uploaded File Info
const uploadedFileInfo = document.querySelector('#uploadedFileInfo');

// Uploaded File  Name
const uploadedFileName = document.querySelector('.uploaded-file__name');

// Uploaded File Icon
const uploadedFileIconText = document.querySelector('.uploaded-file__icon-text');

// Uploaded File Counter
const uploadedFileCounter = document.querySelector('.uploaded-file__counter');

// ToolTip Data
const toolTipData = document.querySelectorAll('.upload-area__tooltip-data');


// Images Types
const imagesTypes = [
    "jpeg",
    "png",
    "svg",
    "gif"
];

// Append Images Types Array Inisde Tooltip Data
toolTipData.innerHTML = [...imagesTypes].join(', .');

// When (drop-zoon) has (dragover) Event 
document.addEventListener("dragover", function(event) {
    // prevent default to allow drop
    event.preventDefault();
    // Add Class (drop-zoon--over) On (drop-zoon)
    dropZoon.classList.add('drop-zoon--over');
}, false);


// When (drop-zoon) has (dragleave) Event 
document.addEventListener("dragleave", function(event) {
    // reset background of potential drop target when the draggable element leaves it
    if (event.target.className == "dropzone") {
        event.target.style.background = "";
    }

    // Add Class (drop-zoon--over) On (drop-zoon)
    dropZoon.classList.remove('drop-zoon--over');

}, false);

/* // When (drop-zoon) has (drop) Event 
dropZoon.addEventListener('drop', function(event) {
    // Prevent Default Behavior 
    event.preventDefault();

    // Remove Class (drop-zoon--over) from (drop-zoon)
    dropZoon.classList.remove('drop-zoon--over');

    // Select The Dropped File
    const file = event.dataTransfer.files[0];

    // Call Function uploadFile(), And Send To Her The Dropped File :)
    uploadFile(file);
});
 */

document.addEventListener("drop", function(event) {
    // prevent default action (open as link for some elements)
    event.preventDefault();
    // move dragged element to the selected drop target
    if (event.target.className == "dropzone") {
        event.target.style.background = "";
        dragged.parentNode.removeChild(dragged);
        event.target.appendChild(dragged);
    }

    uploadFile(file);

}, false);

// When (drop-zoon) has (click) Event 
dropZoon.addEventListener('click', function(event) {
    // Click The (fileInput)
    fileInput.click();
});

// When (fileInput) has (change) Event 
fileInput.addEventListener('change', function(event) {
    // Select The Chosen File
    const file = event.target.files[0];

    // Call Function uploadFile(), And Send To Her The Chosen File :)
    uploadFile(file);
});

// Upload File Function
function uploadFile(file) {
    // FileReader()
    const fileReader = new FileReader();
    // File Type 
    const fileType = file.type;
    // File Size 
    const fileSize = file.size;

    // If File Is Passed from the (File Validation) Function
    if (fileValidate(fileType, fileSize)) {
        // Add Class (drop-zoon--Uploaded) on (drop-zoon)
        dropZoon.classList.add('drop-zoon--Uploaded');

        // Show Loading-text
        loadingText.style.display = "block";
        // Hide Preview Image
        previewImage.style.display = 'none';

        // Remove Class (uploaded-file--open) From (uploadedFile)
        uploadedFile.classList.remove('uploaded-file--open');
        // Remove Class (uploaded-file__info--active) from (uploadedFileInfo)
        uploadedFileInfo.classList.remove('uploaded-file__info--active');

        // After File Reader Loaded 
        fileReader.addEventListener('load', function() {
            // After Half Second 
            setTimeout(function() {
                // Add Class (upload-area--open) On (uploadArea)
                uploadArea.classList.add('upload-area--open');

                // Hide Loading-text (please-wait) Element
                loadingText.style.display = "none";
                // Show Preview Image
                previewImage.style.display = 'block';

                // Add Class (file-details--open) On (fileDetails)
                fileDetails.classList.add('file-details--open');
                // Add Class (uploaded-file--open) On (uploadedFile)
                uploadedFile.classList.add('uploaded-file--open');
                // Add Class (uploaded-file__info--active) On (uploadedFileInfo)
                uploadedFileInfo.classList.add('uploaded-file__info--active');
            }, 500); // 0.5s

            // Add The (fileReader) Result Inside (previewImage) Source
            previewImage.setAttribute('src', fileReader.result);

            // Add File Name Inside Uploaded File Name
            uploadedFileName.innerHTML = file.name;

            // Call Function progressMove();
            progressMove();
        });

        // Read (file) As Data Url 
        fileReader.readAsDataURL(file);
    } else { // Else

        this; // (this) Represent The fileValidate(fileType, fileSize) Function

    };
};

// Progress Counter Increase Function
function progressMove() {
    // Counter Start
    let counter = 0;

    // After 600ms 
    setTimeout(() => {
        // Every 100ms
        let counterIncrease = setInterval(() => {
            // If (counter) is equle 100 
            if (counter === 100) {
                // Stop (Counter Increase)
                clearInterval(counterIncrease);
            } else { // Else
                // plus 10 on counter
                counter = counter + 10;
                // add (counter) vlaue inisde (uploadedFileCounter)
                uploadedFileCounter.innerHTML = `${counter}%`
            }
        }, 100);
    }, 600);
};


// Simple File Validate Function
function fileValidate(fileType, fileSize) {
    // File Type Validation
    let isImage = imagesTypes.filter((type) => fileType.indexOf(`image/${type}`) !== -1);

    // If The Uploaded File Type Is 'jpeg'
    if (isImage[0] === 'jpeg') {
        // Add Inisde (uploadedFileIconText) The (jpg) Value
        uploadedFileIconText.innerHTML = 'jpg';
    } else { // else
        // Add Inisde (uploadedFileIconText) The Uploaded File Type 
        uploadedFileIconText.innerHTML = isImage[0];
    };

    // If The Uploaded File Is An Image
    if (isImage.length !== 0) {
        // Check, If File Size Is 2MB or Less
        if (fileSize <= 2000000) { // 2MB :)
            return true;
        } else { // Else File Size
            return alert('Please Your File Should be 2 Megabytes or Less');
        };
    } else { // Else File Type 
        return alert('Please make sure to upload An Image File Type');
    };


};







// :)