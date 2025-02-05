import { Button, Card, TextField } from "@/components/ui";
import { AppLayout } from "@/layouts/app-layout";
import { useForm } from "@inertiajs/react";
import { toast } from "sonner";

type SettingProps = {
    setting: any;
}

export default function SettingIndex({setting} : SettingProps) {

    const { data, setData, errors, processing, post, put } = useForm<any>(setting);

    const onSubmit = (e: { preventDefault: () => void }) => {
        e.preventDefault();

        put(route('web.backoffice.setting.update'), {
            onError: (err) => {
                toast.error(JSON.stringify(err));
            },
            onSuccess: () => {
                toast.success('Data updated successfully');
            }
        });

    }

    return (
        <>
            <form onSubmit={onSubmit} className="grid grid-cols-12 gap-4 my-4" >
                <div className="col-span-12" >
                    <Card>
                        <Card.Header>
                            <Card.Title>Application Setting</Card.Title>
                            <Card.Description>Setting</Card.Description>
                        </Card.Header>
                        <Card.Content className="grid grid-cols-12 gap-4" >
                            <TextField
                                className="col-span-6"
                                label="Travel Costs (Rp)"
                                name="travel_costs"
                                value={data.travel_costs}
                                autoComplete="one-time-code"
                                onChange={(v) => setData("travel_costs", v)}
                                errorMessage={errors.travel_costs}
                                isRequired
                            />
                            <TextField
                                className="col-span-6"
                                label="Platform Costs (Rp)"
                                name="platform_costs"
                                value={data.platform_costs}
                                autoComplete="one-time-code"
                                onChange={(v) => setData("platform_costs", v)}
                                errorMessage={errors.platform_costs}
                                isRequired
                            />
                        </Card.Content>
                        <Card.Footer>
                            <Button intent="custom" isDisabled={processing} type="submit">
                                Submit
                            </Button>
                        </Card.Footer>
                    </Card>
                </div>
            </form>
        </>

    );
}

SettingIndex.layout = (page: React.ReactNode) => <AppLayout children={page} />;
