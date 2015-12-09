<?php
namespace WebCoding\Repositories;

use Illuminate\Http\RedirectResponse;
use WebCoding\Models\Activity;

/**
 * Class UserRepository
 * @package WebCoding\Repositories
 */
class ActivityRepository extends Repository
{
    /**
     * Constructeur
     *
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->model = $activity;
    }

    /**
     * Create a new activity
     *
     * @param $request
     * @param $content
     * @param array $args
     * @return static
     */
    public function create($request, $content, $args = [])
    {
        return $request->user()->activities()->create([
            'user_id'   =>  $request->user()->id,
            'content'   =>  $content,
            'type'      =>  $args['type']
        ]);
    }

    /**
     * Incrémente le nombre de "likes"
     *
     * @param Activity $activity
     * @return mixed
     */
    public function like(Activity $activity)
    {
        return DB::table($this->model->getTable())->where('id', $activity->id)->increment('likes');
    }

    /**
     * Décrémente le nombre de like
     *
     * @param Activity $activity
     * @return mixed
     */
    public function unlike(Activity $activity)
    {
        return DB::table($this->model->getTable())->where('id', $activity->id)->decrement('likes');
    }
}