import Autoplay from "embla-carousel-autoplay"
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "../ui/carousel"
import { Card, CardContent } from "../ui/card"
import { useGoodStore } from "@/store/good"
import { useEffect } from "react"

export function CarouselCard() {
      const { goods,fetchGoods, } = useGoodStore()

  useEffect(() => {
    fetchGoods()
  }, [])
    return (
        <Carousel opts={{
            align: "start",
            loop: true,
        }}
            plugins={[
                Autoplay({
                    delay: 3000,
                }),
            ]} className="w-full max-w-5xl">
            <CarouselContent>
                {goods.map((good) => (
                    <CarouselItem key={good.id} className="md:basis-1/2 lg:basis-1/3">
                        <div className="p-1">
                            <Card>
                                <CardContent className="flex aspect-square items-center justify-center p-6">
                                    <span className="text-3xl font-semibold">{good.title}</span>
                                </CardContent>
                            </Card>
                        </div>
                    </CarouselItem>
                ))}
            </CarouselContent>
            <CarouselPrevious />
            <CarouselNext />

        </Carousel>
    )
}