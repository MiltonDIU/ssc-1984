<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySpouseRequest;
use App\Http\Requests\StoreSpouseRequest;
use App\Http\Requests\UpdateSpouseRequest;
use App\Models\Event;
use App\Models\Spouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SpouseController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('spouse_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Spouse::with(['user', 'event', 'created_by'])->select(sprintf('%s.*', (new Spouse())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'spouse_show';
                $editGate = 'spouse_edit';
                $deleteGate = 'spouse_delete';
                $crudRoutePart = 'spouses';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('avatar', function ($row) {
                if ($photo = $row->avatar) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'avatar', 'user', 'event', 'created_by']);

            return $table->make(true);
        }

        return view('admin.spouses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('spouse_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.spouses.create', compact('created_bies', 'events', 'users'));
    }

    public function store(StoreSpouseRequest $request)
    {
        $spouse = Spouse::create($request->all());

        if ($request->input('avatar', false)) {
            $spouse->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $spouse->id]);
        }

        return redirect()->route('admin.spouses.index');
    }

    public function edit(Spouse $spouse)
    {
        abort_if(Gate::denies('spouse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $spouse->load('user', 'event', 'created_by');

        return view('admin.spouses.edit', compact('created_bies', 'events', 'spouse', 'users'));
    }

    public function update(UpdateSpouseRequest $request, Spouse $spouse)
    {
        $spouse->update($request->all());

        if ($request->input('avatar', false)) {
            if (!$spouse->avatar || $request->input('avatar') !== $spouse->avatar->file_name) {
                if ($spouse->avatar) {
                    $spouse->avatar->delete();
                }
                $spouse->addMedia(storage_path('tmp/uploads/' . basename($request->input('avatar'))))->toMediaCollection('avatar');
            }
        } elseif ($spouse->avatar) {
            $spouse->avatar->delete();
        }

        return redirect()->route('admin.spouses.index');
    }

    public function show(Spouse $spouse)
    {
        abort_if(Gate::denies('spouse_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouse->load('user', 'event', 'created_by');

        return view('admin.spouses.show', compact('spouse'));
    }

    public function destroy(Spouse $spouse)
    {
        abort_if(Gate::denies('spouse_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $spouse->delete();

        return back();
    }

    public function massDestroy(MassDestroySpouseRequest $request)
    {
        Spouse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('spouse_create') && Gate::denies('spouse_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Spouse();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
