# My Prototype

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2F438870f1-f0ea-499a-8056-449c73096e50%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com)

## Things to do:
1. Implement passwordless [based on this package.](https://github.com/grosv/laravel-passwordless-login)
2. Do [datatable](https://spark.bootlab.io/tables-datatables-buttons.html) for the system.
3. Dashboard for resource(analyst, BD, developer, PMO, all) & client
4. Correspondence module in Project.
5. PDF...

```
    public function createPDF() {
      // retreive all records from db
      $data = Employee::all();
      // share data to view
      view()->share('employee',$data);
      $pdf = PDF::loadView('pdf_view', $data);
      // download PDF file with download method
      return $pdf->download('pdf_file.pdf');
    }
```