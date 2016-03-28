  {
  "id": "tasklist",
  "view":"datatable",
  "editable":true,
  "save": "tasklist",

        "columns":[
              { "id":"action",   "header":"<div class='button_add'>add</div>",    "width":50 },
            { "id":"task",   "header":"Task",    "width":50, "editor":"text"},
            { "id":"status",    "header":"Status of the task" , "width":400,"editor":"text"},
            { "id":"note",   "header":"Notes",    "width":150, "fillspace":true,"editor":"text"}
        ],

        "data":{!! $tasklist !!}
      }
